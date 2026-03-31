# DHT22 Datalogger (Raspberry Pi Trixie)

Logt temperatuur en luchtvochtigheid met een DHT22 sensor op een Raspberry Pi (OS Trixie) en slaat dit op in een MariaDB database.

Bevat een automatisch installatiescript met ondersteuning voor data migratie vanaf Bookworm.

---

## Features

* Temperatuur en luchtvochtigheid logging
* MariaDB database opslag
* Automatische installatie
* Data migratie (Bookworm → Trixie)
* Webinterface met grafieken

---

## Snelle start

```bash
git clone https://github.com/kataya718/DataloggerTrixie
cd DataloggerTrixie
chmod +x install_datalogger.sh
./install_datalogger.sh
```

Na installatie: open het IP-adres van je Raspberry Pi in je browser.

---

## Projectstructuur

```
.
├── install_datalogger.sh
├── pythonscripts/
│   ├── leesdht.py
│   ├── temperatuurlogger.py
│   ├── toondata.py
│   ├── MatplotlibDagTemperatuur.py
│   ├── MatplotlibWeekTemperatuur.py
│   ├── MatplotlibMaandTemperatuur.py
│   ├── MatplotlibDagVochtigheid.py
│   ├── MatplotlibWeekVochtigheid.py
│   ├── MatplotlibMaandVochtigheid.py
│   └── BewaarTempGrafiek.py
└── web/
    ├── index.php
    ├── dag.php
    ├── week.php
    ├── maand.php
    ├── all.php
    ├── climate.js
    ├── header.php
    ├── footer.php
    ├── style.css
    └── ...
```

---

## Installatiescript (overzicht)

Het script:

* Installeert Apache, PHP, MariaDB en Python tools
* Maakt database en tabel (`temperatures.temperaturedata`)
* Zet een Python virtual environment op
* Configureert de webserver
* Stelt cronjobs in (elke 15 minuten logging en grafieken)
* Ondersteunt data migratie

---

## Data migratie (optioneel)

Backup op oude Pi:

```bash
sudo mysqldump -u root -p temperatures > dump.sql
```

Kopieer naar nieuwe Pi:

```bash
scp dump.sql gebruiker@IP-ADRES:~/
```

Importeer:

```bash
mariadb -u root -p temperatures < ~/dump.sql
```

---

## Automatisering

* Logging: elke 15 minuten
* Grafiek update: elke 15 minuten
* Configuratie: `/etc/cron.d/datalogger`

---

## Hardware

Sluit de sensor nooit aan terwijl de Raspberry Pi aan staat.

| DHT22 | Raspberry Pi    |
| ----- | --------------- |
| VCC   | 3.3V (Pin 1)    |
| Data  | GPIO22 (Pin 15) |
| GND   | Ground (Pin 14) |

---

## Handige commando's

Laatste data bekijken:

```bash
~/pythonscripts/dhtvenv/bin/python ~/pythonscripts/toondata.py
```

Database reset:

```bash
mariadb -u logger -p -e "TRUNCATE TABLE temperatures.temperaturedata;"
```

---
