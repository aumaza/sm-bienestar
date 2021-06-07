#!/usr/local/bin/bash

fecha=`date +%d-%m-%Y`
archivo="smb_bienestar-$fecha.sql"
mysqldump --user=root --password=slack142 smb_bienestar > $archivo
mv $archivo sqls/
echo -e "Database Backing Up Successfully \n File storage Successfully"

