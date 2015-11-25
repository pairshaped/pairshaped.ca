Pygment It
==========

A WordPress plugin for syntax highlighting using <a href="http://pygments.org/" target="_blank">Pygments</a>, though Pygments is not required to be installed.

By default, Pygment It will auto discover if Pygments is installed (through `command -v pygmentize`). If not, it will use <a href="http://pygments.appspot.com" target="_blank">http://pygments.appspot.com</a> to highlight code (but without support for: highlighted lines, line numbers and line number to start).

This plugin is a improved version of
<a href="https://bitbucket.org/jsturgill/pygments-for-wordpress" target="_blank">https://bitbucket.org/jsturgill/pygments-for-wordpress</a>.

## Features

* Syntax-highlighted code cached as post metadata
* Admin panel to choose theme, default language and Pygments usage (local, external API or auto discover)
* Multiple themes available (github, monokai, railscasts, mustang, among others..)
* Support for `hl_lines` (highlighted lines), `linenos` (line numbers) and `linenostart` (line number to start) when using a local installation of Pygments

## Installation
  1. Clone this repo or upload its content to `/wp-content/plugins/` directory
  2. Activate the plugin through the 'Plugins' menu in WordPress

## Usage

Through `code` shortcode.

##### Using default language set in admin:
    [code]
      # code here
    [/code]

##### Choosing language (all supported languages can be found <a href="http://pygments.org/languages/" target="_blank">here</a>):
    [code language="ruby"]
      # Ruby language syntax highlighting
    [/code]
    
##### Highlighting lines 2 and 3:  
    [code language="ruby" hl_lines="2 3"]
      class PagesController < ApplicationController
        def index
        end      
      end
    [/code]
    
##### Displaying lines, starting with 20:
    [code linenos="table" linenostart="20"]
      # code here
    [/code]
    
## License
This projected is licensed under the terms of the MIT license.
    
<a href='https://pledgie.com/campaigns/26327'><img alt='Click here to lend your support to: Pygment It and make a donation at pledgie.com !' src='https://pledgie.com/campaigns/26327.png?skin_name=chrome' border='0' ></a>