#!/bin/bash

CURRENT_FOLDER=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )

readarray -t VERSIONS < <(find . -maxdepth 1 -type d -printf '%P\n')

# Beginning of outer loop.
for VERSION in "${VERSIONS[@]}"
do
  VERSION_FOLDER="$CURRENT_FOLDER/$VERSION"
  readarray -t LANGUAGES < <(find "$VERSION_FOLDER" -maxdepth 1 -type d -printf '%P\n')

  for LANGUAGE in "${LANGUAGES[@]}"
  do
    SOURCE_PATH="$CURRENT_FOLDER/$VERSION/$LANGUAGE"
    TARGET_PATH="$CURRENT_FOLDER/_data"

    LANG_VERSION="$LANGUAGE-$VERSION"
    LANG_VERSION=${LANG_VERSION//./-}

    SOURCE_SIDEBAR="$SOURCE_PATH/sidebar.json"
    SOURCE_RIGHT="$SOURCE_PATH/right-menu.json"

    TARGET_SIDEBAR="$LANG_VERSION-sidebar.json"
    TARGET_RIGHT="$LANG_VERSION-right-menu.json"

    if [[ -e "$SOURCE_SIDEBAR" ]]
    then
      echo "Copying: $TARGET_SIDEBAR"
      echo "Copying: $SOURCE_RIGHT"
      cp -v "$SOURCE_SIDEBAR" "$TARGET_PATH/$TARGET_SIDEBAR"
      cp -v "$SOURCE_RIGHT" "$TARGET_PATH/$TARGET_RIGHT"
    fi
  done
done
# End of outer loop.

exit 0
