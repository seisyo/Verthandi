## Project Verthandi

## 簡介

Project Verthandi 為台灣學生所聚集而成的研討會 "SITCON 學生計算機年會" 財務組建立之財務系統
（SITCON Financial System）建置計畫。

此系統建置計畫大致分為兩階段：

第一階段為建置伍此財務系統中 “會計功能” 的部分。功能包含會計基本流程之日記簿、分類帳和生成報表。
此階段的使用者限為總副召和財務組組員。

第二階段為開放各組組長可至此系統之ISSUE管理部分，可以將每一筆支出以一個個ISSUE的方式做管理和追蹤。

## 安裝步驟

1. 安裝 apache2
2. 安裝 php
3. 安裝 mariadb
4. 安裝 composer
5. 安裝 laravel
6. 安裝 git
7. clone 檔案到 /var/www
    git clone https://github.com/seisyo/Verthandi.git
8. cd /var/www/Verthandi 之後 composer install
9. sudo apt-get install nodejs-legacy
10. sudo apt-get install npm
11. npm install --global gulp
12. npm install
13. sudo chmod -R 755 /var/www/laravel
14. sudo chmod -R 777 /var/www/Verthandi/resources


