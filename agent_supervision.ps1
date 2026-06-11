# Encodage UTF-8
[Console]::OutputEncoding = [System.Text.Encoding]::UTF8
$OutputEncoding = [System.Text.Encoding]::UTF8

# Configuration
$API_URL = "http://localhost:8000/api/supervision"

# Hostname
$HOSTNAME = $env:COMPUTERNAME

# OS
$OS_NAME = (Get-WmiObject Win32_OperatingSystem).Caption

# CPU usage
$CPU = (Get-WmiObject Win32_Processor | Measure-Object -Property LoadPercentage -Average).Average
$CPU = "$CPU%"

# RAM
$RAM_INFO = Get-WmiObject Win32_OperatingSystem
$RAM_TOTAL = [math]::Round($RAM_INFO.TotalVisibleMemorySize / 1024)
$RAM_FREE = [math]::Round($RAM_INFO.FreePhysicalMemory / 1024)
$RAM_USED = $RAM_TOTAL - $RAM_FREE
$RAM = "$RAM_USED/$RAM_TOTAL MB"

# Disque
$DISK = Get-WmiObject Win32_LogicalDisk -Filter "DeviceID='C:'"
$DISK_TOTAL = [math]::Round($DISK.Size / 1GB, 1)
$DISK_FREE = [math]::Round($DISK.FreeSpace / 1GB, 1)
$DISK_USED = $DISK_TOTAL - $DISK_FREE
$DISQUE = "$DISK_USED/$DISK_TOTAL GB"

# Uptime
$UPTIME = (Get-Date) - (gcim Win32_OperatingSystem).LastBootUpTime
$UPTIME_STR = "$([math]::Floor($UPTIME.TotalHours))h $($UPTIME.Minutes)min"

# Envoi des données
$BODY = @{
    hostname = $HOSTNAME
    os       = $OS_NAME
    cpu      = $CPU
    ram      = $RAM
    disque   = $DISQUE
    uptime   = $UPTIME_STR
} | ConvertTo-Json

try {
    $RESPONSE = Invoke-RestMethod -Uri $API_URL `
        -Method POST `
        -ContentType "application/json" `
        -Body $BODY

    Write-Host "[OK] OS successfully detected : $OS_NAME"
    Write-Host "[OK] Data sent successfully !"
    Write-Host "Answer : $($RESPONSE.message)"
} catch {
    Write-Host " Error : $_"
}