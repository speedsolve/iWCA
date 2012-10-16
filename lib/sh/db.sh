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

mysql -u root -D wcaTmp -e 'drop table Single'
mysql -u root -D wcaTmp -e 'drop table Singles'
mysql -u root -D wcaTmp -e 'UPDATE Countries SET continentId=REPLACE (continentId,"_","")'

mysql -u root -D wcaTmp -e 'ALTER TABLE Persons MODIFY gender VARCHAR(6);'
mysql -u root -D wcaTmp -e 'UPDATE Persons SET gender=REPLACE (gender,"m","Male")'
mysql -u root -D wcaTmp -e 'UPDATE Persons SET gender=REPLACE (gender,"f","Female")'
mysql -u root -D wcaTmp -e 'UPDATE Persons SET gender=REPLACE (gender,"FeMale","Female")'

mysql -u root -D wcaTmp -e 'create table Single as select value1 as single,personName,personId,personCountryId,competitionId,eventId from Results where value1 not in (0,-1,-2) union select value2,personName,personId,personCountryId,competitionId,eventId from Results where value2 not in (0,-1,-2) union select value3,personName,personId,personCountryId,competitionId,eventId from Results where value3 not in (0,-1,-2) union select value4,personName,personId,personCountryId,competitionId,eventId from Results where value4 not in (0,-1,-2) union select value5,personName,personId,personCountryId,competitionId,eventid from Results where value5 not in (0,-1,-2) order by single, personName'
mysql -u root -D wcaTmp -e 'create table Singles as select single,personId,personName,personCountryId,continentId,competitionId,eventId from Single left join Countries on Single.personCountryId = Countries.Id'
mysql -u root -D wcaTmp -e 'alter table Singles add column id int auto_increment primary key'
mysql -u root -D wcaTmp -e 'alter table Singles add column year int'

mysql -u root -D wcaTmp -e "update Singles set year = 1982 where competitionId like '%1982%'"
mysql -u root -D wcaTmp -e "update Singles set year = 2003 where competitionId like '%2003%'"
mysql -u root -D wcaTmp -e "update Singles set year = 2004 where competitionId like '%2004%'"
mysql -u root -D wcaTmp -e "update Singles set year = 2005 where competitionId like '%2005%'"
mysql -u root -D wcaTmp -e "update Singles set year = 2006 where competitionId like '%2006%'"
mysql -u root -D wcaTmp -e "update Singles set year = 2007 where competitionId like '%2007%'"
mysql -u root -D wcaTmp -e "update Singles set year = 2008 where competitionId like '%2008%'"
mysql -u root -D wcaTmp -e "update Singles set year = 2009 where competitionId like '%2009%'"
mysql -u root -D wcaTmp -e "update Singles set year = 2010 where competitionId like '%2010%'"
mysql -u root -D wcaTmp -e "update Singles set year = 2011 where competitionId like '%2011%'"
mysql -u root -D wcaTmp -e "update Singles set year = 2013 where competitionId like '%2013%'"

echo 'Singlesテーブル作成しました。'

mysql -u root -D wcaTmp -e 'drop table Single'
mysql -u root -D wcaTmp -e 'drop table Average'
mysql -u root -D wcaTmp -e 'drop table Averages'

mysql -u root -D wcaTmp -e 'create table Average as select personId,personName,average,value1,value2,value3,value4,value5,personCountryId,competitionId,eventId from Results where average not in (0,-1,-2) order by average'
mysql -u root -D wcaTmp -e 'create table Averages as select average,personId,personName,value1,value2,value3,value4,value5,personCountryId,continentId,competitionId,eventId from Average left join Countries on Average.personCountryId = Countries.Id'
mysql -u root -D wcaTmp -e 'alter table Averages add column id int auto_increment primary key'
mysql -u root -D wcaTmp -e 'alter table Averages add column year int'

mysql -u root -D wcaTmp -e "update Averages set year = 1982 where competitionId like '%1982%'"
mysql -u root -D wcaTmp -e "update Averages set year = 2003 where competitionId like '%2003%'"
mysql -u root -D wcaTmp -e "update Averages set year = 2004 where competitionId like '%2004%'"
mysql -u root -D wcaTmp -e "update Averages set year = 2005 where competitionId like '%2005%'"
mysql -u root -D wcaTmp -e "update Averages set year = 2006 where competitionId like '%2006%'"
mysql -u root -D wcaTmp -e "update Averages set year = 2007 where competitionId like '%2007%'"
mysql -u root -D wcaTmp -e "update Averages set year = 2008 where competitionId like '%2008%'"
mysql -u root -D wcaTmp -e "update Averages set year = 2009 where competitionId like '%2009%'"
mysql -u root -D wcaTmp -e "update Averages set year = 2010 where competitionId like '%2010%'"
mysql -u root -D wcaTmp -e "update Averages set year = 2011 where competitionId like '%2011%'"
mysql -u root -D wcaTmp -e "update Averages set year = 2012 where competitionId like '%2012%'"
mysql -u root -D wcaTmp -e "update Averages set year = 2013 where competitionId like '%2013%'"

echo 'Averagesテーブル作成しました。'

mysql -u root -D wcaTmp -e 'drop table Average'
mysql -u root -D wcaTmp -e 'create table Competition as select Competitions.id,Competitions.name,cityName,countryId,continentId,information,year,month,day,endMonth,endDay,eventSpecs,wcaDelegate,organiser,venue,venueAddress,venueDetails,website,cellName,Competitions.latitude,Competitions.longitude from Competitions left join Countries on Competitions.countryId = Countries.id'
mysql -u root -D wcaTmp -e 'create table Competition2 as select * from Competition order by year,month,day ASC'
mysql -u root -D wcaTmp -e 'drop table Competitions'
mysql -u root -D wcaTmp -e 'alter table Competition2 add column (number int auto_increment primary key)'
mysql -u root -D wcaTmp -e 'create table Competitions as select * from Competition2 order by number DESC'
mysql -u root -D wcaTmp -e 'drop table Competition';
mysql -u root -D wcaTmp -e 'drop table Competition2';

echo 'CompetitionsにcontinentIdを加え、開催順に並び替えCompetitionsテーブルを作成しなおしました。'

echo '現在の国籍を作成しました。'

mysql -u root -D wcaTmp -e 'create table Result as select competitionId, eventId, roundId, pos, best, average, personName, personId, personCountryId, Countries.continentId, formatId, value1, value2, value3, value4, value5, regionalSingleRecord, regionalAverageRecord from Results left join Countries on Results.personCountryId = Countries.id'
mysql -u root -D wcaTmp -e 'drop table Results';
mysql -u root -D wcaTmp -e 'alter table Result rename to Results';

echo 'Resultsテーブルに大陸名を記載しました。';

mysql -u root -D wcaTmp -e 'alter table Results add column (id int auto_increment primary key)'

echo 'ResultsテーブルにIDを追加しました。'

mysql -u root -D wcaTmp -e 'alter table Results add column year int'

mysql -u root -D wcaTmp -e "update Results set year = 1982 where competitionId like '%1982%'"
mysql -u root -D wcaTmp -e "update Results set year = 2003 where competitionId like '%2003%'"
mysql -u root -D wcaTmp -e "update Results set year = 2004 where competitionId like '%2004%'"
mysql -u root -D wcaTmp -e "update Results set year = 2005 where competitionId like '%2005%'"
mysql -u root -D wcaTmp -e "update Results set year = 2006 where competitionId like '%2006%'"
mysql -u root -D wcaTmp -e "update Results set year = 2007 where competitionId like '%2007%'"
mysql -u root -D wcaTmp -e "update Results set year = 2008 where competitionId like '%2008%'"
mysql -u root -D wcaTmp -e "update Results set year = 2009 where competitionId like '%2009%'"
mysql -u root -D wcaTmp -e "update Results set year = 2010 where competitionId like '%2010%'"
mysql -u root -D wcaTmp -e "update Results set year = 2011 where competitionId like '%2011%'"
mysql -u root -D wcaTmp -e "update Results set year = 2012 where competitionId like '%2012%'"
mysql -u root -D wcaTmp -e "update Results set year = 2013 where competitionId like '%2013%'"

echo 'Resultsテーブルにyearを追加しました。'

mysql -u root -D wcaTmp -e "update Singles set year = 2010 where competitionId = 'BicentenarioOpen'"
mysql -u root -D wcaTmp -e "update Averages set year = 2010 where competitionId = 'BicentenarioOpen'"
mysql -u root -D wcaTmp -e "update Results set year = 2010 where competitionId = 'BicentenarioOpen'"

echo '例外処理をしました。'

mysql -u root -D wcaTmp -e "create index Results_index on Results (personId, eventId, best, average, competitionId, roundId, pos)"
mysql -u root -D wcaTmp -e "create index Competitions_index on Competitions (id,  countryId, continentId, year)"
mysql -u root -D wcaTmp -e "create index Persons_index on Persons (id, name)"

echo 'indexを貼りました。'

rm --force WCA* READ*

echo 'SQL, READMEを削除しました'

#subidをもつものがいるとGenderを加える際レコードが2重になるので修正.
mysql -u root -D wcaTmp -e "create table Result as select competitionId, eventId, roundId, pos, best, average, personId, personName, gender, personCountryId, continentId, formatId, value1, value2, value3, value4, value5, regionalSingleRecord, regionalaverageRecord, Results.id, year from Results left join Persons on Results.personId = Persons.id"
mysql -u root -D wcaTmp -e 'drop table Results'
mysql -u root -D wcaTmp -e 'create table Results as select * from Result group by id'
mysql -u root -D wcaTmp -e 'drop table Result'

echo 'ResultsテーブルにGenderを追加しました'

mysql -u root -D wcaTmp -e "create table Single as select Singles.id,single,personId,personName,gender,personCountryId,continentId,eventId,competitionId,year from Singles left join Persons on Singles.personId = Persons.id"
mysql -u root -D wcaTmp -e 'drop table Singles'
mysql -u root -D wcaTmp -e 'create table Singles as select * from Single group by id'
mysql -u root -D wcaTmp -e 'drop table Single'

echo 'SinglesテーブルにGenderを追加しました。'

mysql -u root -D wcaTmp -e "create table Average as select Averages.id,average,personId,personName,gender,value1,value2,value3,value4,value5,personCountryId,continentId,eventId,competitionId,year from Averages left join Persons on Averages.personId = Persons.id"

mysql -u root -D wcaTmp -e 'drop table Averages'
mysql -u root -D wcaTmp -e 'create table Averages as select * from Average group by id'
mysql -u root -D wcaTmp -e 'drop table Average'

echo 'AveragesテーブルにGenderを追加しました。'

mysql -u root -D wcaTmp -e "create table Single as select Singles.id,single,personId,personName,gender,personCountryId,Singles.continentId,eventId,competitionId,name as competitionName,Singles.year from Singles left join Competitions on Singles.competitionId = Competitions.id"
mysql -u root -D wcaTmp -e 'drop table Singles'
mysql -u root -D wcaTmp -e 'create table Singles as select * from Single group by id'
mysql -u root -D wcaTmp -e 'drop table Single'

echo 'SinglesテーブルにCompetitionNameを追加しました。'

mysql -u root -D wcaTmp -e "create table Average as select Averages.id,average,personId,personName,gender,value1,value2,value3,value4,value5,personCountryId,Averages.continentId,eventId,competitionId,name as competitionName,Averages.year from Averages left join Competitions on Averages.competitionId = Competitions.id"

mysql -u root -D wcaTmp -e 'drop table Averages'
mysql -u root -D wcaTmp -e 'create table Averages as select * from Average group by id'
mysql -u root -D wcaTmp -e 'drop table Average'

echo 'AveragesテーブルにCompetitionNameを追加しました。'

mysql -u root -D wcaTmp -e "alter table Averages add index Averages_index (id,average,gender,personCountryId,continentId,eventId,year)"
mysql -u root -D wcaTmp -e "alter table Singles add index Singles_index (id,single,gender,personCountryId,continentId,eventId,competitionId,year)"

# id追加
mysql -u root -D wcaTmp -e 'alter table RanksSingle add column id int auto_increment primary key'
mysql -u root -D wcaTmp -e 'alter table RanksAverage add column id int auto_increment primary key'

mysql -u root -D wcaTmp -e 'drop table if exists Result'

mysqldump -u root wcaTmp > wca.dump
mysql -u root -D wca < wca.dump
rm wca.dump

echo 'DBを移し変えました。'
