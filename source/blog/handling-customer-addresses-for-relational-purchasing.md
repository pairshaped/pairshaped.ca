---
title: "Handling Customer Addresses for Relational Purchasing"
date: 2011-03-20
tags: [design, database]
author: "Dave Rapin"
published: true
---

A problem I often run into whenver I build an ordering system is how best to store addresses for customers and orders in an ordering system (like an ecommerce store).

Given the following conditions for an order placement application:

* Customer's can register and supply seperate billing and shipping addresses.
* Orders need to store customer data as a snapshot of when the order was placed in case the customer data is changed or removed in the future (orders should maintain historical integrity).


We have several different ways of accomplishing this with a relational database (document and KV stores are a different story).

1. Store all address information within the customer and order tables themselves. This is perhaps the easiest solution even though it's not the most normalized. So you'd have fields like billing_city and shipping_city inside both the customers and the orders tables. The downside is that you've created duplicates of the same fields, which uses up a little more storage space (usually not an issue) and requires more work to maintain if you ever needed to change their schema (again, pretty rare occurence for address fields that are well known entities). The upside is it's very simple to work with from a code perspective.

2. Store addresses in their own table and associate them to orders and customers using via polymorphic composite keys. In order for this to work you'll need a composite key of 3 fields; address_type, addressable_type, addressable_id. So the shipping address for a customer would be something like: "Shipping", "Customer", 1232. and the billing address for an order could be: "Billing", "Order", 2873. etc. The downside is it's a rather fancy assoication and will add complexity to your ORM code as you override some methods (since no ORM I know of is built to handle this oddball relationship out of the box). The upside is it's very normalized and you can add new address types on the fly and new classes that can have addresses on the fly.

3. Store addresses in their own table, but simplify the association by using many-to-one foreign keys. For this to work we just have keys in the address table for each assoication. So in this case we have "billing_customer_id", "shipping_customer_id", "billing_order_id", "shipping_order_id". The downside is it's not very normalized / DRY and you won't be able to add new address types or addressable classes on the fly like you could using the plymorphic associations. The upside is very simple (almost all convention based) ORM code since you're dealing with belongs_to type relationships.

4. Use an Address class to define your address fields, but serialize it to text fields wherever it's used. So you're ditching the relational style just for the addresses. For this to work you'd have two text fields in your orders table and your customers table; "billing_address" and "shipping_address". Then you just serialize your address objects to these fields (yaml, xml, json, or whatever). The upside is the same simplicity as solution #1, but without all of the redundancy in your schema. The downside is the potential complexity of code needed to edit and manage the address information and get proper validations to work.

My preferred solution is #4. I think it's worth the added complexity at the view level when using Rails 3 since it's not too much extra work (although it could be a little cleaner).

