cls
$my_ping = Test-NetConnection 8.8.8.8 -TraceRoute -InformationLevel Detailed
$destination = $my_ping.ComputerName
$my_active_card = $my_ping.NetAdapter.InterfaceDescription
$troad = $my_ping.TraceRoute
$latency = $my_ping.PingReplyDetails.RoundtripTime

" J'ai testé le $destination avec ma carte $my_active_card La latence fût de $latency Et les IP empruntées sur le trajet fûrent :$troad "