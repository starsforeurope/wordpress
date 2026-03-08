# Workflow WordPress Stars For Europe

Questo repository contiene il sorgente WordPress modificabile + l'output statico per GitHub Pages.

Flusso:
1. Modifica contenuti in Local
2. Genera file statici con Simply Static (in `docs/`)
3. Doppio click su `deploy.command` per export DB + commit + push
4. GitHub Actions pubblica `docs/` su `gh-pages`

## 1) Prerequisiti macOS

Installa Homebrew (se manca):

```bash
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
```

Installa gli strumenti necessari:

```bash
brew install git wp-cli mysql-client
```

Controllo rapido:

```bash
git --version
wp --info
mysqldump --version
```

Se `mysqldump --version` non funziona, aggiungi MySQL client al `PATH`.

Apple Silicon:

```bash
echo 'export PATH="/opt/homebrew/opt/mysql-client/bin:$PATH"' >> ~/.zshrc
source ~/.zshrc
```

Intel Mac:

```bash
echo 'export PATH="/usr/local/opt/mysql-client/bin:$PATH"' >> ~/.zshrc
source ~/.zshrc
```

## 2) Installare Local (Flywheel)

Scarica Local:

- https://localwp.com/releases/

Installalo, aprilo almeno una volta e consenti i permessi richiesti da macOS.

## 3) Configurazione Da Zero In Local

Segui questi passaggi su una macchina nuova o quando devi ricreare il sito locale.

Percorso consigliato per il clone:
- `~/Projects/starsforeurope/wordpress`

Esempio:

```bash
mkdir -p ~/Projects/starsforeurope
cd ~/Projects/starsforeurope
git clone git@github.com:starsforeurope/wordpress.git
cd wordpress
```

1. Clona il repository sul Mac.
2. In Local, crea un nuovo sito chiamato `starsforeurope`.
3. Ferma il sito in Local.
4. In Finder, apri la cartella del sito:
	- `~/Local Sites/starsforeurope/`
5. Sostituisci la cartella `app/` del sito con la cartella `app/` del repository.
6. Riavvia il sito in Local.
7. Importa il database dalla root del repo:

```bash
wp --path=app/public db import app/sql/local.sql
```

8. Accedi all'admin WordPress da Local e verifica pagine e contenuti.

Note:
- `wp-admin/`, `wp-includes/` e `wp-config.php` non sono tracciati in git.
- Tieni Local avviato quando modifichi/esporti.

## 4) Pubblicare Le Modifiche

1. Modifica i contenuti in WordPress (Local).
2. Esegui export con Simply Static per aggiornare `docs/`.
3. Fai doppio click su `deploy.command` nella root del repository.

`deploy.command` esegue:
1. `wp db export app/sql/local.sql`
2. `git add .`
3. `git commit -m "content: <timestamp>"`
4. `git push`

## 5) GitHub Actions

File workflow: `.github/workflows/deploy.yml`

Si attiva al push su `main` e pubblica `docs/` su `gh-pages`.
