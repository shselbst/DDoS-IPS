#!/bin/bash
# solution for .php files to prevent cross-site scripting. looks for variables in .php and surrounds them in htmlspecialchars() so that script tags are not rendered
# USE: sudo ./xss_sol.sh input_file.php output_file.php


# check if we have been given the correct amount of parameters
if [ "$#" -ne 2 ]; then
    echo "Usage: $0 input_file output_file"
    exit 1 # Exit with error
fi

# input file is the first argument
input_file=$1
# output file is the second argument
output_file=$2

# make the output file if it doesnt exist already
touch "$output_file"

# check if the input file exists and exit with error if not
if [ ! -f "$input_file" ]; then
    echo "Input file does not exist."
    exit 1 # exit with eror
fi

# usee sed to surround any calls to a variable from a list (like superglobal array like POST  or grabbing from an array of inputs] with htmlspecialchars()
# Corrected pattern and replacement
sed "s/\$[^[$]*\[[^]]*\]/htmlspecialchars(&)/g" "$input_file" > "$output_file"

# output new file's contents
cat "$output_file"

