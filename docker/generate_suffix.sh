#!/bin/sh
# Generate a random suffix
SUFFIX=$(date +%s | sha256sum | head -c 10)
echo "$SUFFIX"
