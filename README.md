
# Flashcards  

Flashcards is a small application made using Laravel Commands

To start using flashcards you first need to have Docker installed and run the following command:


```bash
./vendor/bin/sail up
```

# Available Commands

## Application Menu
```bash
./vendor/bin/sail artisan flashcards:interactive 
```

## Option 1 (Create a Flashcard)

You will be prompted a Question and an Answer for your flashcard. 

You can also create a flashcard using the command:
```bash
./vendor/bin/sail artisan flashcards:new 
```
## Option 2 (List )

A table will appear with all the Flashcards and their answers. 

You can also list the flashcards using the command:
```bash
./vendor/bin/sail artisan flashcards:list 
```

## Option 3 (Pratice)

Your current progress will be shown and you will be prompted to choose one flashcard that has not been answered correctly yet (Your progress will be kept untill you reset it).

You can also pratice with the flashcards using the command:
```bash
./vendor/bin/sail artisan flashcards:pratice 
```


## Option 4 (Show stats)

Show your completition stats

You can also see your completition stats using the command:
```bash
./vendor/bin/sail artisan flashcards:stats 
```

## Option 5 (Reset)

All your answers will be cleared but the flashcards will remain.

You can also see your reset your progress using the command:
```bash
./vendor/bin/sail artisan flashcards:reset 
```


## Option 6 (Exit)

Exit the application menu