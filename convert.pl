#!/usr/bin/perl

use strict;
use warnings;

while (<>) {
    # Remove backticks
    s/`//g;
    # Remove ENGINE and charset
    s/ENGINE=.*;//g;
    s/DEFAULT CHARSET.*;//g;
    # Remove COLLATE
    s/ COLLATE [^,)]*//g;
    # Remove UNSIGNED
    s/UNSIGNED//g;
    # Change AUTO_INCREMENT to SERIAL
    s/AUTO_INCREMENT/SERIAL/g;
    # Change mediumtext to text
    s/mediumtext/text/g;
    # Change enum to varchar
    s/enum\([^)]+\)/varchar(255)/g;
    # Change bigint to bigint (keep)
    # For id SERIAL, but since it's in MODIFY, need to change the CREATE
    # But for simplicity, print
    print;
}