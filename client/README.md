## Panduan untuk Clone

Akses [github repo](https://github.com/AzisWh/Rimba-House)

open your terminal

```bash
git clone https://github.com/AzisWh/Rimba-House
#
cd Rimba-House
cd client
```

konfigurasi env:

```bash
cp .env.example .env
```

## Env 

```bash
const ENV = {
  API_URL: 'api url',
};
#
contoh
const ENV = {
  API_URL: 'http://127.0.0.1:8000/api',
};
```

## RUN DENGAN LIVE SERVER