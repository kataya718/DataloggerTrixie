# 🌡️ DHT22 Datalogger (Raspberry Pi Trixie)

Logt temperatuur en luchtvochtigheid met een **DHT22 sensor** op een **Raspberry Pi (OS Trixie)** en slaat dit op in een **MariaDB database**.

Inclusief een **automatisch installatiescript** met ondersteuning voor **data migratie vanaf Bookworm**.

---

## 🚀 Features

* 📊 Temperatuur & luchtvochtigheid logging
* 🗄️ MariaDB database
* ⚙️ Volledige automatische installatie
* 🔄 Migratie van oude data (Bookworm → Trixie)
* 🌐 Webinterface + grafieken

---

## ⚡ Snelle Start

```bash
git clone https://github.com/kataya718/DataloggerTrixie
cd DataloggerTrixie
chmod +x install_datalogger.sh
./install_datalogger.sh
```

Na installatie: open je browser op het IP-adres van je Raspberry Pi.

---

## 📁 Projectstructuur

```
.
├── install_datalogger.sh
├── pythonscripts/
│   ├── leesdht.py
│   ├── temperatuurlogger.py
│   ├── toondata.py
│   └── BewaarTempGrafiek.py
└── web/
    ├── index.php
    ├── dag.php
    ├── week.php
    ├── maand.php
    └── ...
```

---

## ⚙️ Wat doet het installatiescript?

* Installeert Apache, PHP, MariaDB en Python tools
* Maakt database + tabel (`temperatures.temperaturedata`)
* Zet Python venv op met DHT22 libraries
* Configureert webserver (`/var/www/html`)
* Zet cronjobs (elke 15 min logging + grafiek)
* Biedt optie voor data migratie

---

## 🔄 Data Migratie (optioneel)

Op oude Pi (Bookworm):

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

## ⏱️ Automatisering

* Logging: elke 15 min
* Grafiek update: elke 15 min
* Alles via `/etc/cron.d/datalogger`

---

## ⚠️ Hardware Waarschuwing

Sluit de DHT22 **nooit aan terwijl de Pi aan staat** — kans op permanente schade.

| DHT22 | Raspberry Pi    |
| ----- | --------------- |
| VCC   | 3.3V (Pin 1)    |
| Data  | GPIO22 (Pin 15) |
| GND   | Ground (Pin 14) |

---

## 🛠️ Handige commands

Laatste data bekijken:

```bash
~/pythonscripts/dhtvenv/bin/python ~/pythonscripts/toondata.py
```

Database reset:

```bash
mariadb -u logger -p -e "TRUNCATE TABLE temperatures.temperaturedata;"
```

---

## 📄 Licentie

MIT License
