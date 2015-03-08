#!/bin/bash

set -e

recess --compress --compile less/*.less > css/freelancer.css

echo "Done"
exit 0
