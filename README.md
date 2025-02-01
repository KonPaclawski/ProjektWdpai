# ProjektWdpai - Aplikacja do zarządzania budżetem
Projekt pozwala na zarządzanie swoim budżetem
Pozwala ona na zarządzanie osobistym budżetem, umożliwiając śledzenie wydatków, użytkownicy mogą tworzyć kategorie wydatków ich tytuły, cena, następną datę zapłaty. 
## Technologie
Aplikacja powstała przy użyciu <br/>
-PHP <br/>
-JavaScript <br/>
-FetchAPI <br/>
-PostgreSQL <br/>
-HTML <br/>
-CSS <br/>
-Docker 
## Instalacja
Skopiuj repozytiorum </br>
 ```bash
   git clone --branch projekt https://github.com/[twoje_uzytkownik]/budzet-app.git <nazwa_pliku>
  ```
Z włączoną aplikacją dockera wpisz
```bash
   docker-compose up --build
  ```
Zarejestruj serwer oraz dodaj baze danych
```bash
  hostname: db
  name: db
  user: docker
  password: docker
  Oraz utwórz baza danych
  name: db
```
Wczytaj bazę danych
```bash
  Get-Content backup.sql | docker exec -i 06039bc8ea3422559fe121ecc9ebd7d971c662ddf5bc63f133630f8f8d8b9527 psql -U docker -d db
  ```
Wejdź na adres
```bash
  http://localhost:8080/login
```

## Użycie
Użytkownik może dodawać swoje konto oraz logować się na nie </br>
Pozwala tworzyć nowe budżety z kategoriami tytułami,cenami i datami zapłaty </br>
Pozwala zobaczyć swoje założone budżety </br>
Pozwala w budżetach usuwać kategorie oraz dodawać nowe </br>
