# [Nome Feature]

<!--
ISTRUZIONI DI COMPILAZIONE (rimuovere prima dell'uso)
- Scrivi per un agente che non conosce il progetto: deve poter implementare senza fare domande.
- Per feature grandi: compila solo "Obiettivo" e "Tasks" nella spec principale.
  Ogni task complesso merita un file separato YYYYMMDD_nome_task.md che estende questa spec.
- "File coinvolti" per area: più sei preciso, meno token vengono sprecati in scansione.
- "Pattern di riferimento": indica UN solo file da cui prendere esempio. Non più di uno.
- "Fuori scope": è il campo che evita il 90% delle iterazioni di correzione.
- "Acceptance criteria": scrivi condizioni osservabili (cosa si vede / cosa ritorna), non intenzioni.
- Non rimuovere il blocco "Note implementative": è il contesto di progetto per chi implementa.
-->

## Meta
| Campo | Valore |
|---|---|
| **Data** | YYYY-MM-DD |
| **Branch** | feature/nome-branch |
| **Area** | Es. Proposta d'ordine / Formule / Statistiche |
| **Stato** | open |
| **Spec padre** | [specs/feature/YYYYMMDD_spec_padre.md] *(se è una estensione)* |

## Obiettivo
<!-- Una frase. Cosa deve fare questa feature al termine dell'implementazione. -->


## Contesto di business
<!-- Max 3 righe. Perché serve. Salta se ovvio. -->


## Tasks
<!-- Numera i task in ordine di implementazione (dipendenze prima). -->
- [ ] 1. [Task breve]
- [ ] 2. [Task breve]
- [ ] 3. [Task breve]

---

## Dettaglio tasks

### Task 1 — [Nome task]

**Layer coinvolti:** DB / Model / Service / Controller / View *(segna solo quelli toccati)*

**File coinvolti:**
- `database/migrations/` — nuova migrazione per [tabella]
- `app/Models/NomeModel.php` — [cosa aggiungere]
- `app/Services/NomeService.php` — [metodo da aggiungere/modificare]
- `app/Http/Controllers/Admin/NomeController.php` — [metodo da aggiungere/modificare]
- `resources/views/admin/modulo/index.blade.php` — [componente UI da aggiungere]

**Pattern di riferimento:**
- Prendi esempio da: `resources/views/admin/[modulo_esempio]/index.blade.php`

**Descrizione:**
<!-- Descrizione tecnica del task. Includi: logica di business, regole di validazione,
     comportamento su edge case, messaggi di errore attesi. -->


**Acceptance criteria:**
- [ ] [Condizione verificabile]
- [ ] [Condizione verificabile]

---

### Task 2 — [Nome task]

**Layer coinvolti:** DB / Model / Service / Controller / View

**File coinvolti:**
- `...`

**Descrizione:**


**Acceptance criteria:**
- [ ] [Condizione verificabile]

---

## Fuori scope — non toccare
- Non modificare [modulo correlato ma non richiesto]
- Non refactorare codice funzionante nelle vicinanze
- Non aggiungere funzionalità non elencate sopra

## Note implementative
<!-- Blocco standard, identico in tutte le spec del progetto. Non rimuoverlo e non riassumerlo:
     è il contesto per chi implementa, che potrebbe non avere altre informazioni sul progetto. -->

### Perimetro del lavoro
- Modifica solo i file elencati in "File coinvolti". Se durante l'implementazione ne serve un altro, segnalalo e spiega perché, invece di toccarlo in silenzio.
- Non aggiungere funzionalità che la spec non chiede, nemmeno se sembrano utili o naturali.
- Non rifattorizzare codice funzionante che la spec non menziona: puoi migliorare solo il codice che stai già modificando per completare il task (vedi la sezione seguente).
- Prima di modificare un file, leggilo per intero nella parte che ti riguarda. Prima di creare un Model, un Service o un Controller, verifica che non esista già.
- Se la spec è ambigua o in contrasto con quello che trovi nel codice, fermati e chiedi invece di decidere da solo.

### Codice esistente: presunzione di correttezza
<!-- Regola di sicurezza, la più importante del blocco: evita che una modifica non richiesta
     arrivi in produzione senza che nessuno l'abbia valutata. -->
- Il codice che la spec non ti chiede di toccare va considerato corretto e voluto, anche quando ti sembra sbagliato: è già stato scritto, testato, approvato e messo in produzione.
- Quello che sembra un errore spesso è una regola di business o la cicatrice di un bug reale: una condizione ridondante, un controllo apparentemente inutile, un caso particolare trattato a parte. In questo progetto molti di quei punti riportano in commento il motivo e il commit che li ha introdotti: leggili prima di concludere che c'è un difetto.
- Se credi di aver trovato un bug o un errore di logica fuori dal perimetro della spec, **non correggerlo**. Annotalo nel rapporto finale con file, riga, cosa ti sembra sbagliato e perché, e lascia decidere a chi ha scritto la spec: se merita, diventerà una spec a parte.
- Vale anche quando la correzione sembra ovvia e a costo zero: una modifica non richiesta su codice funzionante è un rischio che nessuno ha valutato e che chi legge il tuo lavoro non si aspetta di trovare.
- Se per completare il task devi per forza modificare quel codice, fermati e chiedi prima di procedere, spiegando cosa cambieresti e cosa potrebbe dipenderne.

### Architettura
- Rispetta la separazione dei livelli: il Controller riceve la richiesta e risponde, il Service contiene la logica di business, il Model rappresenta i dati e le relazioni. Se il modulo ha già un Service, la logica nuova va lì, non nel Controller.
- Riusa quello che c'è già invece di riscriverlo (DRY): prima di aggiungere un metodo, cerca se esiste un equivalente, a partire dal file indicato in "Pattern di riferimento".
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
- Usa il TDD quando ha senso: per una correzione, scrivi prima il test che riproduce il problema e che fallisce; per una funzionalità, scrivi il test insieme al codice.
- Copri con i test il comportamento descritto negli "Acceptance criteria", compresi i casi limite citati nella spec.
- Esegui `php artisan test` prima di considerare concluso il lavoro.
- Se un test esistente fallisce, capisci perché prima di toccarlo: va cambiato solo se la spec cambia volutamente quel comportamento, e in quel caso dillo esplicitamente.

### Consegna
- Non eseguire commit se non ti viene chiesto esplicitamente.
- A fine lavoro riporta: cosa hai modificato file per file, come l'hai verificato, cosa resta aperto o non verificabile.
- Nello stesso rapporto elenca a parte **quello che hai notato ma non toccato**: dubbi sulla logica esistente, codice che ti sembrava sbagliato, scorciatoie che hai evitato. È l'unico modo che ha chi legge per decidere se ci sia davvero qualcosa da correggere.
