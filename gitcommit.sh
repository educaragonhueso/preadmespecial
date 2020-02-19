CUSTOM_DATE=$(date "+%d-%m-%Y")
mysqldump -uroot -pSuricato1.fp prehgir > copias_bdatos/out.${CUSTOM_DATE}.sql 
git add -A
git commit -m $1
git push origin master
