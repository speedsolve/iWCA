#!/bin/bash

#sqlファイルのURL用の日付変数
url="http://www.worldcubeassociation.org/results/misc/"$1

wget --spider -t 1 $url

wget -t 1 -nv $url

cp $1 ../../data/sql/wca/
echo 'sqlのバックアップをしました'

unzip $1

sed -e s/latin1/utf8/ WCA_export.sql > wca.sql

mysql -u root wcaTmp < wca.sql

echo 'DBのデータを更新しました。'

rm wca.sql
rm --force WCA* READ*
echo 'SQL, READMEを削除しました'

# Persons
mysql -u root -D wcaTmp -e 'ALTER TABLE Persons MODIFY gender VARCHAR(6);'
mysql -u root -D wcaTmp -e 'UPDATE Persons SET gender=REPLACE (gender,"m","Male")'
mysql -u root -D wcaTmp -e 'UPDATE Persons SET gender=REPLACE (gender,"f","Female")'
mysql -u root -D wcaTmp -e 'UPDATE Persons SET gender=REPLACE (gender,"FeMale","Female")'

# Countries
mysql -u root -D wcaTmp -e 'UPDATE Countries SET continentId=REPLACE (continentId,"_","")'

# Competition
mysql -u root -D wcaTmp -e 'create table Competition as select Competitions.id,Competitions.name,cityName,countryId,continentId,information,year,month,day,endMonth,endDay,eventSpecs,wcaDelegate,organiser,venue,venueAddress,venueDetails,website,cellName,Competitions.latitude,Competitions.longitude from Competitions left join Countries on Competitions.countryId = Countries.id'
mysql -u root -D wcaTmp -e 'create table Competition2 as select * from Competition order by year,month,day ASC'
mysql -u root -D wcaTmp -e 'drop table if exists Competitions'
mysql -u root -D wcaTmp -e 'alter table Competition2 add column (number int auto_increment primary key)'
mysql -u root -D wcaTmp -e 'create table Competitions as select * from Competition2 order by number DESC'
mysql -u root -D wcaTmp -e 'drop table if exists Competition';
mysql -u root -D wcaTmp -e 'drop table if exists Competition2';
echo 'CompetitionsにcontinentIdを加え、開催順に並び替えCompetitionsテーブルを作成しなおしました。'

# Results
mysql -u root -D wcaTmp -e 'create table Result as select competitionId, eventId, roundId, pos, best, average, personName, personId, personCountryId, Countries.continentId, formatId, value1, value2, value3, value4, value5, regionalSingleRecord, regionalAverageRecord from Results left join Countries on Results.personCountryId = Countries.id'
mysql -u root -D wcaTmp -e 'drop table if exists Results';
mysql -u root -D wcaTmp -e 'alter table Result rename to Results';
echo 'Resultsテーブルに大陸名を記載しました。';
mysql -u root -D wcaTmp -e 'create table Result as select competitionId, eventId, roundId, pos, best, average, personName, personId, personCountryId, Results.continentId, formatId, value1, value2, value3, value4, value5, regionalSingleRecord, regionalAverageRecord, Competitions.name as competitionName, countryId, Competitions.year, month, day, endMonth, endDay from Results left join Competitions on Results.competitionId = Competitions.id'
mysql -u root -D wcaTmp -e 'drop table if exists Results';
mysql -u root -D wcaTmp -e 'alter table Result rename to Results';
echo 'ResultsテーブルにCompetitionDataを追加しました。'
mysql -u root -D wcaTmp -e 'alter table Results add column (id int auto_increment primary key)'
echo 'ResultsテーブルにIDを追加しました。'

#subidをもつものがいるとGenderを加える際レコードが2重になるので修正.
mysql -u root -D wcaTmp -e "create table Result as select competitionId,eventId,gender,roundId,pos,best,average,personId,personName,personCountryId,continentId,formatId,value1,value2,value3,value4,value5,regionalSingleRecord,regionalaverageRecord,Results.id,competitionName,Results.countryId,year,month,day,endMonth,endDay from Results left join Persons on Results.personId = Persons.id"
mysql -u root -D wcaTmp -e 'drop table if exists Results'
mysql -u root -D wcaTmp -e 'create table Results as select * from Result group by id'
mysql -u root -D wcaTmp -e 'drop table if exists Result'
echo 'ResultsテーブルにGenderを追加しました'

# Single
mysql -u root -D wcaTmp -e 'drop table if exists Single'
mysql -u root -D wcaTmp -e 'drop table if exists Singles'
mysql -u root -D wcaTmp -e 'create table Single as select value1 as single,personName,personId,gender,personCountryId,competitionId,eventId,competitionName,countryId,year,month,day,endMonth,endDay from Results where value1 not in (0,-1,-2) union select value2,personName,personId,gender,personCountryId,competitionId,eventId,competitionName,countryId,year,month,day,endMonth,endDay from Results where value2 not in (0,-1,-2) union select value3,personName,personId,gender,personCountryId,competitionId,eventId,competitionName,countryId,year,month,day,endMonth,endDay from Results where value3 not in (0,-1,-2) union select value4,personName,personId,gender,personCountryId,competitionId,eventId,competitionName,countryId,year,month,day,endMonth,endDay from Results where value4 not in (0,-1,-2) union select value5,personName,personId,gender,personCountryId,competitionId,eventid,competitionName,countryId,year,month,day,endMonth,endDay from Results where value5 not in (0,-1,-2) order by single, personName'
mysql -u root -D wcaTmp -e 'create table Singles as select single,personId,gender,personName,personCountryId,continentId,competitionId,eventId,competitionName,countryId,year,month,day,endMonth,endDay from Single left join Countries on Single.personCountryId = Countries.Id'
mysql -u root -D wcaTmp -e 'alter table Singles add column id int auto_increment primary key'
mysql -u root -D wcaTmp -e 'drop table if exists Single'
echo 'Singlesテーブル作成しました。'

# Average
mysql -u root -D wcaTmp -e 'drop table if exists Average'
mysql -u root -D wcaTmp -e 'drop table if exists Averages'
mysql -u root -D wcaTmp -e 'create table Average as select personId,gender,personName,average,value1,value2,value3,value4,value5,personCountryId,competitionId,eventId,competitionName,countryId,year,month,day,endMonth,endDay from Results where average not in (0,-1,-2) order by average'
mysql -u root -D wcaTmp -e 'create table Averages as select average,personId,gender,personName,value1,value2,value3,value4,value5,personCountryId,continentId,competitionId,eventId,competitionName,countryId,year,month,day,endMonth,endDay from Average left join Countries on Average.personCountryId = Countries.Id'
mysql -u root -D wcaTmp -e 'alter table Averages add column id int auto_increment primary key'
mysql -u root -D wcaTmp -e 'drop table if exists Average'
echo 'Averagesテーブル作成しました。'

# Ranks
mysql -u root -D wcaTmp -e 'alter table RanksSingle add column id int auto_increment primary key'
mysql -u root -D wcaTmp -e 'alter table RanksAverage add column id int auto_increment primary key'

# Scrambles
mysql -u root -D wcaTmp -e 'alter table Scrambles add column id int auto_increment primary key'

# Other
mysql -u root -D wcaTmp -e "alter table Averages add index Averages_index (id,average,gender,personCountryId,continentId,eventId,year)"
mysql -u root -D wcaTmp -e "alter table Singles add index Singles_index (id,single,gender,personCountryId,continentId,eventId,competitionId,year)"
mysql -u root -D wcaTmp -e "create index Results_index on Results (personId, eventId, best, average, competitionId, roundId, pos)"
mysql -u root -D wcaTmp -e "create index Competitions_index on Competitions (id,  countryId, continentId, year)"
mysql -u root -D wcaTmp -e "create index Persons_index on Persons (id, name)"
mysql -u root -D wcaTmp -e "create index Scrambles_index on Scrambles (competitionId)"

echo 'indexを貼りました。'

mysqldump -u root wcaTmp > wca.dump
mysql -u root -D wca < wca.dump
rm wca.dump

echo 'DBを移し変えました。'
