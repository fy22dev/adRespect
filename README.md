# Kilka uwag:

* routing jest zdefiniowany w pliku `index.php`
* docelowa kwota przewalutowania jest przechowywana w kolumnie `decimal(10,2)`. Formualrz zwróci błąd jeśli obliczona kwota przekroczy ten zakres.
* w kodzie HTML są style. Tak, wiem że tak się nie robi, ale jest ich ze trzy i są kompletnie nieistotne w kwestii rozwiązania zadania.
* poszedłem na łatwiznę w  kwestii metod operujacych na bazie danych (`__call()`), ale celem zadania nie była budowa ORM, więc pozwoliłem sobie na takie uproszczenie.
* nie wiedziałem do końca co to jest 'przewalutowana kwota', więc wrzucam w bazę danych wynik obliczeń po zmianie waluty.
* tak, wiem że używanie VO w takim projekcie to może być przerost formy nad treścią.
* brak tłumaczeń, więc komunikaty walidacji encji są po polsku.
* jesli zawiedzie połączenie bazą danych albo CURL, kod przerywa działanie.

# Instalacja

* pobranie plików z repozytorium
* utworzenie bazy danych (`sql/create_database.sql`)
* utworzenie pliku konfiguracji połączenia z bazą danych (`app/config/database.php`)
* `composer install`