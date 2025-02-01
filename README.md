# ProjektWdpai - Aplikacja do zarządzania budżetem
Projekt pozwala na zarządzanie swoim budżetem
Pozwala ona na zarządzanie osobistym budżetem, umożliwiając śledzenie wydatków, użytkownicy mogą tworzyć kategorie wydatków ich tytuły, cena, następną datę zapłaty. 
## Technologie  
Projekt został zrealizowany przy użyciu:  
- **PHP**  
- **JavaScript**  
- **Fetch API**  
- **PostgreSQL**  
- **HTML & CSS**  
- **Docker**  

## Instalacja  

1. **Sklonuj repozytorium:**  
   ```bash
   git clone --branch projekt https://github.com/[twoje_uzytkownik]/budzet-app.git <nazwa_folderu>
   ```
2. **Uruchom aplikację w Dockerze:**  
   ```bash
   docker-compose up --build
   ```
3. **Skonfiguruj bazę danych:**  
   - **Host:** `db`  
   - **Nazwa bazy:** `db`  
   - **Użytkownik:** `docker`  
   - **Hasło:** `docker`  
4. **Załaduj kopię zapasową bazy danych:**  
   ```bash
   Get-Content backup.sql | docker exec -i $(docker ps -qf "name=db") psql -U docker -d db
   ```
5. **Otwórz aplikację w przeglądarce:**  
   ```
   http://localhost:8080/login
   ```

## Użycie  
- Rejestracja i logowanie użytkowników.  
- Tworzenie nowych budżetów z kategoriami wydatków.   
- Przeglądanie utworzonych budżetów.  
- Dodawanie i usuwanie kategorii w istniejących budżetach.  
