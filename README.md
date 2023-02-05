# Minesweeper

The first board shows all values, the second shows what was selected, in this case I called `reveal(3,3);` that is line: 3 column: 3, if you want to change what line and column will be called, just change the values of reveal function call:

<img width="213" alt="Captura de Tela 2023-02-05 às 17 48 56" src="https://user-images.githubusercontent.com/36545266/216845266-560b2c2e-86c8-44f3-8326-1d597244bc58.png">

This second example also calling: `reveal(3,3);` the board had an empty value, so it was revealed all squares recursively until it reached a number by the game rules: 

<img width="269" alt="Captura de Tela 2023-02-05 às 17 49 59" src="https://user-images.githubusercontent.com/36545266/216845279-3b61a4ae-52da-45ab-9cf8-f6cee593fe44.png">

This example is when the selected line and column was a bomb:

<img width="226" alt="Captura de Tela 2023-02-05 às 17 51 07" src="https://user-images.githubusercontent.com/36545266/216845287-89ae08b9-19b3-4023-ab4b-2d73195c7160.png">
