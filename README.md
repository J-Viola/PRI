# Seminární práce z předmětu "Programování pro internet"

Tento projekt je ukázkovým projektem webové aplikace, která využívá různé technologie pro serverovou, databázovou a klientskou část. Níže je podrobný popis použitých technologií a struktury projektu.

## Technologie

### Server (Back-end)
- **PHP**: Hlavní serverový jazyk použitý pro zpracování požadavků a generování dynamického obsahu.
- **XML**: Používá se pro strukturování dat playlistů.

### Databáze
- **MySQL**: Relační databázový systém použitý pro ukládání uživatelských účtů a playlistů.

### Klient (Front-end)
- **HTML**: Základní značkovací jazyk pro strukturování webových stránek.
- **CSS**: Používá se pro stylování webových stránek.
- **JavaScript**: Používá se pro interaktivitu na straně klienta.

## Styly
- **Bootstrap**: CSS framework pro responzivní a moderní design. [Bootstrap dokumentace](https://getbootstrap.com/docs/4.1/getting-started/introduction/)
- **Pixabay**: Zdroj obrázků. [Pixabay](https://pixabay.com/cs/illustrations/)
- **Font Awesome**: Ikony pro webové aplikace. [Font Awesome](https://fontawesome.com/v4/cheatsheet/)

## Struktura Projektu

### Docker
Projekt využívá Docker pro snadné nasazení a správu závislostí.

#### Služby
- **PHP + Apache**: Kontejner pro PHP a Apache server.
- **MySQL**: Kontejner pro MySQL databázi.
- **Adminer**: Nástroj pro správu databáze.

### PHP Soubory
- **index.php**: Hlavní stránka aplikace.
- **prolog.php**: Konfigurační soubor obsahující definice konstant a funkce pro správu uživatelů.
- **navbar.php**: Navigační lišta.
- **html-begin.php** a **html-end.php**: Šablony pro začátek a konec HTML dokumentu.
- **db.php**: Funkce pro práci s databází.
- **tools.php**: Nástroje pro práci s XML.
- **boxes.php**: Funkce pro zobrazení zpráv (chyby, úspěchy).

### XML
- **playlist.xsd**: XML Schema pro validaci playlistů.
- **playlist.dtd**: DTD definice pro validaci playlistů.
- **playlist.xsl**: XSLT šablona pro transformaci XML do HTML.

### Příklady XML souborů
- **test_1_valid.xml**: Validní XML soubor s playlistem.
- **test_2_valid.xml**: Druhý validní XML soubor s playlistem.
- **test_3_not_valid.xml**: Nevalidní XML soubor s playlistem.


## Nasazení
Pro nasazení projektu použijte Docker Compose. Ujistěte se, že máte nainstalovaný Docker a Docker Compose. Poté spusťte následující příkaz v kořenovém adresáři projektu:

```sh
docker-compose up --build
```

Tím se spustí všechny služby definované v `compose.yaml` souboru.

## Závěr
Tento projekt demonstruje použití různých technologií pro vytvoření webové aplikace, která umožňuje uživatelům nahrávat a spravovat playlisty. Projekt je navržen tak, aby byl snadno rozšiřitelný a udržovatelný.
