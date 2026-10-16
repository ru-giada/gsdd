# [Nome Refactoring]

<!--
ISTRUZIONI DI COMPILAZIONE (rimuovere prima dell'uso)
- Scrivi per un agente che non conosce il progetto: deve poter intervenire senza fare domande.
- Il refactoring NON deve cambiare comportamento visibile. Dichiaralo esplicitamente.
  Se invece il comportamento cambia volutamente, scrivilo in testa alla spec: non è un refactoring puro.
- "File da migrare" e "File da NON toccare" sono i campi più critici.
- "Test di non regressione" serve per verificare che il comportamento sia invariato.
- Usa "Approccio" per dare la direzione senza prescrivere ogni riga di codice.
- Non rimuovere il blocco "Note implementative": è il contesto di progetto per chi implementa.
-->

## Meta
| Campo | Valore |
|---|---|
| **Data** | YYYY-MM-DD |
| **Branch** | refactor/nome-branch |
| **Area** | Es. Services / Controllers / DB |
| **Stato** | open |

## Problema attuale
<!-- Cosa c'è di sbagliato nel codice ora. Conciso. -->


## Obiettivo del refactoring
<!-- Stato finale desiderato. Cosa migliora (leggibilità / performance / manutenibilità). -->
<!-- Il comportamento visibile per l'utente NON deve cambiare. -->


## File da migrare
<!-- Lista precisa dei file coinvolti con il motivo. -->
| File | Motivo |
|---|---|
| `app/Services/NomeService.php` | [Es. metodo X troppo lungo, logica Y da estrarre] |
| `app/Http/Controllers/Admin/NomeController.php` | [Es. logica da spostare nel Service] |

## File da NON toccare
<!-- Esplicita cosa è fuori scope. -->
- `app/Models/NomeModel.php` — il modello non va toccato
- `resources/views/` — nessuna modifica alle viste
- [altro]

## Approccio
<!-- Descrivi la strategia. Es: "Estrarre metodo X in classe Y", "Spostare logica Z dal Controller al Service". -->
<!-- Non prescrivere ogni riga, ma dai la direzione. -->
1. [Passo 1]
2. [Passo 2]
3. [Passo 3]

## Test di non regressione
<!-- Come verificare che il comportamento NON è cambiato dopo il refactoring. -->
- [ ] [Scenario funzionale da testare manualmente]
- [ ] [Unit test da far girare: `php artisan test --filter=NomeTest`]

## Acceptance criteria
- [ ] Il comportamento visibile per l'utente è invariato
- [ ] I test esistenti passano senza modifiche
- [ ] [Criterio specifico del refactoring]

## Note implementative
<!-- Blocco standard, identico in tutte le spec del progetto. Non rimuoverlo e non riassumerlo:
     è il contesto per chi implementa, che potrebbe non avere altre informazioni sul progetto. -->

### Perimetro del lavoro
- Il comportamento visibile non deve cambiare: a parità di input l'applicazione deve produrre gli stessi risultati di prima, salvo quanto dichiarato esplicitamente nella spec.
- Procedi a passi piccoli e verificabili, eseguendo i test a ogni passo: un refactoring che cambia molte cose insieme non è verificabile e, se qualcosa si rompe, non si capisce dove.
- Modifica solo i file elencati in "File da migrare" e rispetta "File da NON toccare". Se durante l'implementazione ne serve un altro, segnalalo e spiega perché, invece di toccarlo in silenzio.
- Non aggiungere funzionalità e non correggere bug che incontri per strada (vedi la sezione seguente).
- Prima di modificare un file, leggilo per intero nella parte che ti riguarda. Prima di creare un Model, un Service o un Controller, verifica che non esista già.
- Se la spec è ambigua o in contrasto con quello che trovi nel codice, fermati e chiedi invece di decidere da solo.

### Codice esistente: presunzione di correttezza
<!-- Regola di sicurezza, la più importante del blocco. Qui il rischio è particolare: stai
     legittimamente riscrivendo del codice, quindi è facile "sistemare" anche la logica. -->
- Puoi cambiare la **forma** del codice, mai la **sostanza**: spostarlo, rinominarlo, dividerlo in metodi più piccoli, eliminare duplicazioni. Quello che fa deve restare identico.
- Il codice che stai riscrivendo va considerato corretto e voluto, anche quando ti sembra sbagliato: è già stato scritto, testato, approvato e messo in produzione.
- Quello che sembra un errore spesso è una regola di business o la cicatrice di un bug reale: una condizione ridondante, un controllo apparentemente inutile, un caso particolare trattato a parte. In questo progetto molti di quei punti riportano in commento il motivo e il commit che li ha introdotti: leggili prima di concludere che c'è un difetto, e portali con te quando sposti il codice.
- Se mentre riscrivi un blocco ti convinci che la sua logica sia sbagliata, **lascialo come è**: riproducila fedelmente, anche se ti sembra illogica, e annota il dubbio nel rapporto finale con file, riga e motivo. Sarà chi ha scritto la spec a decidere se è un bug.
- Vale anche quando la correzione sembra ovvia e a costo zero: mescolata al refactoring rende impossibile capire se un'eventuale regressione dipende dallo spostamento o dalla modifica di logica.

### Architettura
- Rispetta la separazione dei livelli: il Controller riceve la richiesta e risponde, il Service contiene la logica di business, il Model rappresenta i dati e le relazioni. Se il modulo ha già un Service, la logica spostata va lì, non nel Controller.
- Riusa quello che c'è già invece di riscriverlo (DRY): prima di aggiungere un metodo, cerca se esiste un equivalente.
- Un'informazione deve avere una sola fonte di verità: se lo stesso calcolo è duplicato in più punti, il refactoring è l'occasione per lasciarne uno solo, richiamato dagli altri.
- Un'operazione che scrive su più tabelle deve essere atomica: racchiudila in una transazione, così un errore a metà non lascia dati incoerenti.

### Nomi e struttura del codice
- Usa nomi che dicano cosa contiene una variabile o cosa fa un metodo. Evita sigle e abbreviazioni non già in uso nel progetto.
- Segui la lingua già usata nel modulo che stai modificando, senza mescolare italiano e inglese nello stesso contesto.
- Scrivi funzioni brevi, che facciano una cosa sola. Se per descrivere un metodo ti serve una "e", probabilmente sono due metodi.
- Rendi espliciti gli input e gli output: passa i dati come parametri e restituisci un valore, invece di modificare stato condiviso di nascosto.
- Mantieni basso il livello di annidamento: esci presto dai casi particolari (return anticipato) invece di incapsulare tutto in `if` sempre più profondi.

### Commenti e documentazione
- Commenta ogni classe e ogni metodo con PHPDoc: cosa fa, parametri, valore di ritorno.
- Nei commenti dentro al corpo spiega il **perché**, non il cosa: la riga di codice dice già cosa succede. Sono utili i vincoli non ovvi, le scelte controintuitive e i rimandi alla spec o al bug che le ha motivate.
- Quando sposti o riscrivi del codice, porta con te i commenti che lo spiegano e aggiornali: un commento rimasto indietro è peggio di nessun commento.

### Gestione degli errori
- Mantieni invariato il comportamento in caso di errore: stessi messaggi, stesse eccezioni, stessi log, salvo quanto la spec dichiari di voler cambiare.
- Gestisci l'errore dove sai cosa farne. Se non puoi gestirlo, lascialo propagare: non catturarlo per nasconderlo.
- Non lasciare mai un `catch` vuoto o che ingoia l'eccezione senza traccia: se catturi, registra almeno un log con il contesto utile a capire cosa è successo.

### Stile
- Segui lo standard PSR-12 per il codice PHP.
- Rispetta lo stile del file che stai modificando (indentazione, posizione delle parentesi, convenzioni di naming), anche quando differisce dalle tue abitudini.

### Test
- Se il codice da rifattorizzare non è coperto da test, scrivili **prima** di toccarlo: senza una rete di sicurezza non puoi dimostrare che il comportamento è rimasto invariato.
- I test esistenti devono passare senza modificarne le aspettative. Se per farli passare devi cambiare un'asserzione, il comportamento è cambiato: fermati e segnalalo.
- Esegui `php artisan test` prima di considerare concluso il lavoro, e verifica anche gli scenari elencati in "Test di non regressione".

### Consegna
- Non eseguire commit se non ti viene chiesto esplicitamente.
- A fine lavoro riporta: cosa hai modificato file per file, come hai verificato che il comportamento è invariato, cosa resta aperto o non verificabile.
- Nello stesso rapporto elenca a parte **quello che hai notato ma non toccato**: logiche che ti sembravano sbagliate e che hai riprodotto fedelmente, duplicazioni lasciate, dubbi rimasti. È l'unico modo che ha chi legge per decidere se ci sia davvero qualcosa da correggere.
