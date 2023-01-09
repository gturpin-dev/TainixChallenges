#!/bin/bash

# This script is used to create a new challenge directory and default files based on a prompted variable

# Prompt the user for the challenge code if not provided as an argument
if [ -z "$1" ]; then
	echo "Enter the challenge code ( example: CHALLENGE_1 ): "
	read CHALLENGE_CODE
else
	CHALLENGE_CODE=$1
fi

# Create a new variable with from this format "CHALLENGE_CODE_1" to "Challenge_Code_1"
# lowercase CHALLENGE_CODE
CAMELCASE_CHALLENGE_CODE=$(echo $CHALLENGE_CODE | tr '[:upper:]' '[:lower:]')

# Split it into an array by the underscore
IFS='_' read -r -a array <<< "$CAMELCASE_CHALLENGE_CODE"

# Uppercase the first letter of each array element
for i in "${!array[@]}"; do
	array[$i]=$(echo ${array[$i]} | awk '{print toupper(substr($0,1,1)) substr($0,2)}')
done

# Join the array elements back together with underscores
CAMELCASE_CHALLENGE_CODE=$(IFS=_; echo "${array[*]}")

# Uppercase the challenge_code
CHALLENGE_CODE=$(echo $CAMELCASE_CHALLENGE_CODE | tr '[:lower:]' '[:upper:]')

# We have now two versions of the code :
# CHALLENGE_CODE_1
# Challenge_Code_1

PHP_FILENAME=$CAMELCASE_CHALLENGE_CODE.php

# Check if the challenge directory already exists
if [ -d "src/Challenges/$CHALLENGE_CODE" ]; then
	echo "The challenge directory already exists"
	exit 1
fi

# Check if the challenge file already exists
if [ -f "src/Challenges/$CHALLENGE_CODE/$PHP_FILENAME.php" ]; then
	echo "The challenge file already exists"
	exit 1
fi

# Create the challenge file in src/challenges/$CHALLENGE_CODE in CamelCase like Challenge_1.php
mkdir src/Challenges/$CHALLENGE_CODE
touch src/Challenges/$CHALLENGE_CODE/$PHP_FILENAME
touch src/Challenges/$CHALLENGE_CODE/data.json

# Put the content of the boilerplate file to the new challenge file
cat src/ChallengeBoilerplate.php > src/Challenges/$CHALLENGE_CODE/$PHP_FILENAME

# Replace "CHALLENGE_BOILERPLATE" in the new challenge file by CHALLENGE_CODE case sensitive
sed -i "s/CHALLENGE_BOILERPLATE/$CHALLENGE_CODE/g" src/Challenges/$CHALLENGE_CODE/$PHP_FILENAME

# Replace "Challenge_Boilerplate" in the new challenge file by CAMELCASE_CHALLENGE_CODE case sensitive
sed -i "s/Challenge_Boilerplate/$CAMELCASE_CHALLENGE_CODE/g" src/Challenges/$CHALLENGE_CODE/$PHP_FILENAME

exit 0