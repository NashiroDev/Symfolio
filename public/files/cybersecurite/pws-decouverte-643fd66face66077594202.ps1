# if ("Nouveau Fichier" ou "Fichier Modifi�") do { Backup}

# Mon dossier de travail : /cheminDeMonDossierFirefox
$Dossier_de_Travail = "$env:USERPROFILE\AppData\Local\Google"

# Mon Dossier de Stockage de Sauvegarde : /CheminDunDossierDeSauvegardeSurMaClef
$disk = Get-PsDrive | where Provider -Match Filesystem


foreach ($letter in $disk){

$drive = $letter.root
$pathbackup = $drive + "Script_backup"
$testP = Test-Path -Path $pathbackup

if ($testP -eq $true){ 

" $pathbackup existence : $testP "

}else {

" $pathbackup existence : $testP "

}}



# R�cup�rer le contenu du dossier de travail
$from_save = Get-ChildItem -Path $Dossier_de_Travail -Recurse
# R�cup�rer le contenu du dossier de sauvegardes
$to_save =  Get-ChildItem -Path $pathbackup -Recurse
# Comparer les deux.
Compare-Object -ReferenceObject $from_save -DifferenceObject $to_save -Property lastWritetime -ExcludeDifferent

# Copier les fichiers nouveaux
# Copier les fichiers modifi�s
# Garder une copie des fichiers avant modification?
# Supprimerles fichiers supprim�s dans le dossier de travail? 

