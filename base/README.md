# RssBase

![main branch status](https://img.shields.io/github/checks-status/rssbase/rssbase/main)
![repo size](https://img.shields.io/github/size/rssbase/rssbase/base)

## Requirements

- [PHP](https://www.php.net/downloads.php) `>= 8.1` & [composer](https://getcomposer.org/download/) `>= 2.4`

## Development

```
$ make

# Project
install                        Install project dependencies
clean                          Remove generated files

# Utils
cs                             Run php-cs-fixer
phpstan                        Run phpstan
psalm                          Run psalm
rector                         Run rector

# Tests
tests                          Run all tests
tu                             Run unit tests
tf                             Run functional tests
```
