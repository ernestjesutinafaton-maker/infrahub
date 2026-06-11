#!/bin/bash

API_URL="http://localhost:8000/api/supervision"
HOSTNAME=$(hostname)
OS=$(uname -s)

case "$OS" in
    Linux)
        OS_NAME=$(grep PRETTY_NAME /etc/os-release | cut -d'"' -f2)
        CPU=$(top -bn1 | grep "Cpu(s)" | awk '{print $2}' | cut -d'%' -f1)"%"
        RAM=$(free -m | awk 'NR==2{printf "%s/%sMB (%.1f%%)", $3,$2,$3*100/$2}')
        DISQUE=$(df -h / | awk 'NR==2{printf "%s/%s (%s)", $3,$2,$5}')
        UPTIME=$(uptime -p)
        ;;
    Darwin)
        OS_NAME="macOS $(sw_vers -productVersion)"
        CPU=$(top -l 1 | grep "CPU usage" | awk '{print $3}')
        RAM=$(vm_stat | awk '/Pages active/{print $3*4/1024 " MB used"}')
        DISQUE=$(df -h / | awk 'NR==2{printf "%s/%s (%s)", $3,$2,$5}')
        UPTIME=$(uptime)
        ;;
    *)
        OS_NAME="OS inconnu : $OS"
        CPU="N/A"
        RAM="N/A"
        DISQUE="N/A"
        UPTIME="N/A"
        ;;
esac

curl -s -X POST "$API_URL" \
    -H "Content-Type: application/json" \
    -d "{
        \"hostname\": \"$HOSTNAME\",
        \"os\": \"$OS_NAME\",
        \"cpu\": \"$CPU\",
        \"ram\": \"$RAM\",
        \"disque\": \"$DISQUE\",
        \"uptime\": \"$UPTIME\"
    }"

echo ""
echo "✅ OS détecté : $OS_NAME"
echo "✅ Données envoyées !"