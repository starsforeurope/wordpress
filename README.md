# Workflow WordPress Stars For Europe

Questo repository contiene il sorgente WordPress modificabile + l'output statico per GitHub Pages.

Flusso:
1. Esegui `./setup.sh` una sola volta su ogni macchina
2. Modifica contenuti in Local
3. Genera file statici con Simply Static (in `docs/`)
4. Doppio click su `deploy.command` per export DB + commit + push
5. GitHub Actions pubblica `docs/` su `gh-pages`

## 1) Prerequisiti macOS

Installa Homebrew (se manca):

```bash
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
```

Assicurati che `git` sia disponibile (di solito gia' presente su macOS o installabile via Homebrew).

`setup.sh` installa automaticamente i tool mancanti (`wp-cli` e `mysql-client`).

## 2) Installare Local (Flywheel)

Scarica Local:

- https://localwp.com/releases/

Installalo, aprilo almeno una volta e consenti i permessi richiesti da macOS.

## 3) Setup One-Time (Consigliato)

Esegui:

```bash
./setup.sh
```

Lo script:
1. Verifica prerequisiti (`git`, Homebrew e Local)
2. Installa automaticamente i tool mancanti (`wp-cli`, `mysql-client`)
3. Clona il repo in `~/wordpress-repo` (se manca)
4. Crea ZIP importabile con `app/sql/local.sql` + `app/public/wp-content`
5. Attende conferma dopo import in Local (`starsforeurope`)
6. Collega `~/Local Sites/starsforeurope/app/public/wp-content` al repo con un symlink

Nota importante:
- Se `app/sql/local.sql` contiene il dump di default WordPress, vedrai "Hello world" e "Sample Page" anche in locale.
- `setup.sh` ora mostra un warning esplicito se rileva questo caso.

## 4) Configurazione Manuale (Fallback)

Segui questi passaggi su una macchina nuova o quando devi ricreare il sito locale.

Percorso consigliato per il clone:
- `~/wordpress-repo`

Esempio:

```bash
cd ~
git clone https://github.com/starsforeurope/wordpress.git wordpress-repo
cd wordpress-repo
```

1. Clona il repository sul Mac.
2. In Local, crea un nuovo sito chiamato `starsforeurope`.
3. Ferma il sito in Local.
4. In Finder, apri la cartella del sito:
	- `~/Local Sites/starsforeurope/`
5. Sostituisci la cartella `app/` del sito con la cartella `app/` del repository.
6. Riavvia il sito in Local.
7. Importa il database da Local, puntando al dump dentro il repository:

```bash
cd ~/Local\ Sites/starsforeurope
wp --path=app/public db import "~/wordpress-repo/app/sql/local.sql"
```

8. Accedi all'admin WordPress da Local e verifica pagine e contenuti.

Note:
- `wp-admin/`, `wp-includes/` e `wp-config.php` non sono tracciati in git.
- Tieni Local avviato quando modifichi/esporti.

## 5) Pubblicare Le Modifiche

1. Modifica i contenuti in WordPress (Local).
2. Esegui export con Simply Static per aggiornare `docs/`.
3. Fai doppio click su `deploy.command` nella root del repository.

`deploy.command` esegue:
1. Richiede conferma dopo Generate in Simply Static
2. `wp db export app/sql/local.sql`
3. `git add .`
4. `git commit -m "content: <timestamp>"`
5. `git push`

## 6) GitHub Actions

File workflow: `.github/workflows/deploy.yml`

Si attiva al push su `main` e pubblica `docs/` su `gh-pages`.
