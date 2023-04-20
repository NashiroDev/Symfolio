#Scripte qui sauvegarde un fichier mais qui à chaque execution, copie uniquement les fichiers dont la date de modification ne correspond pas.

$Source_path = "C:\Users\Nathan\AppData\Local\Google"
$key_name = "USBSTOR\DISK&VEN_SANDISK&PROD_SANDISK_3.2_GEN1&REV_DL17\A20015F880701A58&0"
$key_path = "F:\__backup_google"

#Identifier le nom de la clefUSB
#Ouvrir le dossier google sur la clef et verifier toutes les dates de dèrnière modification en les comparant avec celles dans AppData.
#copier les fichiers dont la date de modification est postèrieure à celle du même fichier sur la clef.
####ajouter un élément dans le nom des fichier ré-enregistrés pour ne pas écraser l'ancienne version.


$local_date = Get-ChildItem -Force -Recurse $Source_path    #On recupère les dossiers et sous dossier des chemins renseignées

#tester la présence de la clef; si oui continuer; else message erreur 

$external_date = Get-ChildItem -Force -Recurse $key_path

[System.Collections.ArrayList]$local_file = @()
[System.Collections.ArrayList]$external_file = @() #On créé deux listes vide pour y placer les éléments


Foreach($element in $local_date) {     #boucle for
$local_file.Add(element)     #add() = append() .py

Foreach($element2 in $external_date) { 
$external_file.Add(element2)

}
}

$counter = 0

Foreach ($element in $local_date) {
If($local_file[$counter].LastWriteTimeUtc -ne $external_file[$counter].LastWriteTimeUtc)  { #Si 1 != 2



  # bloc de code (instructions)
  #Copy-Item -Path \\fs\Shared\it\users.xlsx -Destination \\fs2\Backups\it\users.xlsx -Force

$counter += 1
}
}
