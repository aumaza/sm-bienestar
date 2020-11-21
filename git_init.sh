#!/bin/bash

echo "# sm-bienestar" >> README.md
git init
git add README.md
git commit -m "first commit"
git branch -M main
git remote add origin https://github.com/aumaza/sm-bienestar.git
git push -u origin main
