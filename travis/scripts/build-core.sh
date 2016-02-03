#!/usr/bin/env bash

MAKEFILE_HASH="$(drush msha thunder.yml --porcelain=true)"
FILE_PATH="${HOME}/artifacts/${MAKEFILE_HASH}.tar.gz"

if [ ! -d ~/artifacts ]
  then
    mkdir ~/artifacts
fi

if [ -f ${FILE_PATH} ]
  then
    tar -xzf "${FILE_PATH}" -C .
    phing link_custom_code
    phing create_settings

  else
    phing download
    tar -czf "${FILE_PATH}" docroot
    phing link_custom_code
    phing create_settings
fi
