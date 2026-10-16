# [Titolo breve del bug] — Fix

<!--
ISTRUZIONI DI COMPILAZIONE (rimuovere prima dell'uso)
- Scrivi per un agente che non conosce il progetto: deve poter correggere senza fare domande.
- Riempi SOLO i campi pertinenti. Lascia vuoti quelli che non sai.
- "File coinvolti" è il campo più importante: più sei preciso, meno token vengono sprecati.
- "Comportamento attuale/atteso": valori concreti e osservabili, non descrizioni generiche.
- "Ipotesi causa" è opzionale ma dimezza il tempo di debug.
- Mantieni "Fuori scope" aggiornato: impedisce all'agente di "aggiustare" cose non richieste.
- Non rimuovere il blocco "Note implementative": è il contesto di progetto per chi implementa.
-->

## Meta
| Campo | Valore |
|---|---|
| **Data** | YYYY-MM-DD |
| **Branch** | hotfix/nome-branch |
| **Area** | Es. Sostanze / Movimenti / Proposta d'ordine |
| **Priorità** | alta / media / bassa |
| **Stato** | open |

## File coinvolti
<!-- Lista i file con path completo. Aggiungi una riga per ogni file. -->
- `app/Services/NomeService.php` — [breve descrizione del ruolo]
- `app/Http/Controllers/Admin/NomeController.php` — [breve descrizione del ruolo]
- `app/Models/NomeModel.php` — [solo se modifichi il modello]

## Descrizione del bug
<!-- Una o due frasi. Cosa succede di sbagliato e dove. -->


## Steps per riprodurre
1. Vai in `admin/percorso/della/pagina`
2. Esegui [azione specifica]
3. Osserva [risultato errato]

## Comportamento attuale (errato)
<!-- Sii preciso: valori, campi, colonne DB, metodi coinvolti. -->


## Comportamento atteso (corretto)
<!-- Sii preciso quanto sopra. -->


## Ipotesi causa
<!-- Opzionale ma molto utile. Indica metodo sospetto, logica da verificare. -->
<!-- Es: "In ReducedScaleItemService::createNewReducedScaleItemFrom() la discriminazione -->
<!--     per cluster 2 sembra mancare." -->


## Tasks
- [ ] Identificare causa root
- [ ] Applicare fix
- [ ] Verificare assenza di side-effect (vedi "Fuori scope")
- [ ] [Aggiungere migrazione dati se necessario]
- [ ] [Aggiungere/aggiornare unit test]

## Come verificare (acceptance criteria)
<!-- Passi esatti per confermare che il bug è risolto. -->
1. [Condizione verificabile]
2. [Condizione verificabile]

## Fuori scope — non toccare
<!-- Elenca esplicitamente cosa Claude NON deve modificare. -->
- Non modificare [altro modulo/file correlato]
- Non refactorare codice funzionante nelle vicinanze

## Note implementative
<!-- Blocco standard, identico in tutte le spec del progetto. Non rimuoverlo e non riassumerlo:
     è il contesto per chi implementa, che potrebbe non avere altre informazioni sul progetto. -->

### Perimetro del lavoro
- Correggi la causa, non il sintomo: se il valore sbagliato arriva da un altro punto, risali fino a dove nasce invece di aggiustarlo all'arrivo.
- Modifica solo i file elencati in "File coinvolti". Se durante l'implementazione ne serve un altro, segnalalo e spiega perché, invece di toccarlo in silenzio.
- Non aggiungere funzionalità che la spec non chiede, nemmeno se sembrano utili o naturali.
- Non rifattorizzare codice funzionante che la spec non menziona: puoi modificare solo il codice che serve a correggere **questo** bug (vedi la sezione seguente).
- Prima di modificare un file, leggilo per intero nella parte che ti riguarda. Prima di creare un Model, un Service o un Controller, verifica che non esista già.
- Se la spec è ambigua o in contrasto con quello che trovi nel codice, fermati e chiedi invece di decidere da solo.

### Codice esistente: presunzione di correttezza
<!-- Regola di sicurezza, la più importante del blocco. In una correzione il rischio è più alto:
     stai già cercando un difetto, quindi è più facile crederne di trovare anche dove non ci sono. -->
- Il codice che la spec non ti chiede di toccare va considerato corretto e voluto, anche quando ti sembra sbagliato: è già stato scritto, testato, approvato e messo in produzione.
- Quello che sembra un errore spesso è una regola di business o la cicatrice di un bug reale: una condizione ridondante, un controllo apparentemente inutile, un caso particolare trattato a parte. In questo progetto molti di quei punti riportano in commento il motivo e il commit che li ha introdotti: leggili prima di concludere che c'è un difetto.
- Correggi **solo** il difetto descritto in questa spec. Se durante l'indagine ne trovi altri, **non correggerli**: annotali nel rapporto finale con file, riga, cosa ti sembra sbagliato e perché, e lascia decidere a chi ha scritto la spec.
- Vale anche quando la correzione sembra ovvia e a costo zero: una modifica non richiesta su codice funzionante è un rischio che nessuno ha valutato, e mescolata alla correzione vera rende impossibile capire quale delle due ha causato un'eventuale regressione.
- Se la causa del bug sta in codice che la spec dichiara fuori scope, fermati e chiedi prima di procedere, spiegando cosa cambieresti e cosa potrebbe dipenderne.

### Architettura
- Rispetta la separazione dei livelli: il Controller riceve la richiesta e risponde, il Service contiene la logica di business, il Model rappresenta i dati e le relazioni. Se il modulo ha già un Service, la logica nuova va lì, non nel Controller.
- Riusa quello che c'è già invece di riscriverlo (DRY): prima di aggiungere un metodo, cerca se esiste un equivalente.
- Un'informazione deve avere una sola fonte di verità: se un valore è già calcolato da un metodo esistente, richiamalo invece di ricalcolarlo altrove con la stessa formula.
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
- Quando modifichi del codice, aggiorna i commenti che lo descrivono: un commento sbagliato è peggio di nessun commento.

### Gestione degli errori
- Valida gli input dove entrano nel sistema (request, parametri delle rotte, file caricati) e restituisci un messaggio comprensibile a chi usa l'applicazione.
- Gestisci l'errore dove sai cosa farne. Se non puoi gestirlo, lascialo propagare: non catturarlo per nasconderlo.
- Non lasciare mai un `catch` vuoto o che ingoia l'eccezione senza traccia: se catturi, registra almeno un log con il contesto utile a capire cosa è successo.
- Considera i casi limite indicati nella spec (valore nullo, elenco vuoto, record già esistente) e gestiscili esplicitamente.

### Stile
- Segui lo standard PSR-12 per il codice PHP.
- Rispetta lo stile del file che stai modificando (indentazione, posizione delle parentesi, convenzioni di naming), anche quando differisce dalle tue abitudini.

### Test
- Scrivi prima il test che riproduce il bug: deve fallire sul codice attuale e passare dopo la correzione. È la prova che hai corretto davvero quel problema.
- Copri con i test il comportamento descritto in "Come verificare", compresi i casi limite citati nella spec.
- Esegui `php artisan test` prima di considerare concluso il lavoro.
- Se un test esistente fallisce, capisci perché prima di toccarlo: potrebbe essere il test che descriveva il comportamento sbagliato. Va cambiato solo se la spec lo prevede, e in quel caso dillo esplicitamente.

### Consegna
- Non eseguire commit se non ti viene chiesto esplicitamente.
- A fine lavoro riporta: cosa hai modificato file per file, come hai verificato la correzione, cosa resta aperto o non verificabile.
- Nello stesso rapporto elenca a parte **quello che hai notato ma non toccato**: altri difetti sospetti, dubbi sulla logica esistente, codice che ti sembrava sbagliato. È l'unico modo che ha chi legge per decidere se ci sia davvero altro da correggere.