# Game

## Définitions des fichiers de configurations

Par défaut, les fichiers de configurations input.txt et output.txt sont considérés comme étant dans ./public/.

Il est possible de surcharger ces valeurs en définissant un .env dans lequel vous définirez les variables suivantes :

```
INPUT_FILE=/input/config/path.txt
OUTPUT_FILE=/output/config/path.txt
```

## Format des fichiers de configurations

```
C - width - height
M - posX - posY
# comment
T - posX - posY - nbItems
A - Name - posX - posY - orientationInitiale(N,E,O,S) - sequenceAction(A,D,G)
```
