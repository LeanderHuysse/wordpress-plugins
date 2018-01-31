#!/bin/bash
for d in */; do
    echo "$d"
    (
     cd "$d" && 
     rm -rf .git
    )
done
