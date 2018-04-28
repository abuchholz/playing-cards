
alias ll="ls -laFh"

RED="\[\033[0;31m\]"
YELLOW="\[\033[0;33m\]"
GREEN="\[\033[0;32m\]"
WHITE="\[\033[0;37m\]"
BLUE="\[\033[0;96m\]"
USER=$(whoami)
PS1="$WHITE\$(date +%H:%M)$BLUE DOCKER \h $WHITE[$BLUE\$USER$WHITE] \w $ "