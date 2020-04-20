

## About Card Party

My family's favorite past-time when we're all together is to play cards. Most of the time we play Progressive Rummy (also known as Liverpool) but we also play spades, hearts, and someothers as well. Recently I've been looking for a good way for us to play together virtually, and while there are options for other card games, there wasn't one that I could find for Progressive. Thus this project.

## Goals/Thought Dump

- Goal: To play a game of progressive rummy with my family in real time
- Thought: Joining should be like joining a zoom call or JackBok Game
  - Organizer creates game gets unique link to send to group and group joins and enters in info
  - OR Organizer creates game with players and sends link to group
- Don't want in-game chat - there are plenty of other ways to communicate during a game and reinventing the wheel isn't fun
- Automatic scoring
- For starters get working for experienced players, then add validation for actions, then add "house-rules" configurations
- Start off with progressive rummy, then expand to other game options

### How the Swicks Play Progressive Rummy

#### What You Will Need
The game requires two decks of cards with jokers for every two players. I.e. if four players 2 full decks, if five 3 full decks

#### Prerequisites

The basic object of the game is to form melds or card combinations on every new deal, which are previously determined. The player to successfully form the expected meld and lay off all of his/her cards first, wins the respective round. At the end of the game’s seven rounds, the player with the least cumulative score wins the game.

There are two types of melds in Progressive Rummy: ‘Sets’, and ‘Runs’.

A set (abbreviated as ‘S’) is a combination of three or more cards of the same numer where the suit does not matter.<br>
For example, 5 ♥ – 5 ♠ – 5 ♦.

A run (abbreviated as ‘R’) on the other hand is a sequence of four or more consecutive cards all of the same suit.<br>
For example, 4 ♣ – 5 ♣ – 6 ♣ – 7 ♣ .

In case of a run, aces can be either high or low, but not both.

For instance, the correct combinations are:<br>
A ♣ – 2 ♣ – 3 ♣ – 4 ♣ (when the ace is considered low) or<br>
J ♠ – K ♠ – Q ♠ – A ♠ (when the ace is considered high)<br>
However, Q ♣ – K ♣- A ♣- 2 ♣ is not allowed.

The 7 rounds of Play
- Round 1: 6 cards dealt, goal is two sets of three
- Round 2: 7 cards dealt, goal is one set of three and one run of four
- Round 3: 8 cards dealt, goal is two runs of four
- Round 4: 9 cards dealt, goal is three sets of three
- Round 5: 10 cards dealt, goal is two sets of three and one run of four
- Round 6: 11 cards dealt, goal is one set of three and two runs of four
- Round 7: 12 cards dealt, goal is three sets of four

#### Beginning Play

- Shuffle the decks of cards, and deal each player 6 cards to begin the first round.
- Place the rest of the deck in the center and flip the top card; the deck would be used as the draw pile, and the flipped card would begin a discard pile.
- The player to the left of the dealer starts by picking up a card from either the draw or discard pile. They would then try to use it in their hand, and discard a less useful card from their hand.
- The game continues in a similar fashion, where players draw and discard in an attempt to complete the round's goal. Once a player is successful in forming the goal, they would lay it down on the table.
  - After a player lays their cards on the table if they have any cards left (which they only would if they bought at some point in the round), they can play them on other players who have also laid down cards. NOTE: a player who _has not_ laid down cannot play on other player's hands.
- Jokers are used as a wild card, and have the ability to replace any missing card in a particular sequence.
- The round ends when a player discards their last card.
- At the end of each round, players keep a score of the cards that remain in their hand. The point value for each card is given below.

| Cards  | 2 | 3 | 4 | 5 | 6 | 7 | 8 | 9 | 10 | J  | Q  | K  | A  | Joker |
|--------|---|---|---|---|---|---|---|---|----|----|----|----|----|-------|
| Points | 5 | 5 | 5 | 5 | 5 | 5 | 5 | 5 | 10 | 10 | 10 | 10 | 15 | 25    |

#### Buying

You can pick up a card out of turn by "buying" it for the price of picking up two extra cards. Any discarded card is first offered to the player to the left, if they don't want it the remaining players _in order_ have the option to "buy" it.

For example lets say there are four players: Dan, Pam, Andy, and Becca. Dan discarded a seven of hearts and Becca says she wants the card.

If Pam wants the seven of hearts, she can pick it up without picking up extra cards, even though Becca wants it.
Then Andy gets the option to buy it, then if Andy doesn't want it Becca can pick up the seven of hearts and then also must pick up the top two cards off of the deck.

## Contributing

Thank you for considering contributing to Card Party! Please reach out to me on twitter (@andymswick) or send me an email (andymswick@gmail.com) and we can discuss more.

## Security Vulnerabilities

If you discover a security vulnerability within Card Party, please send an e-mail to Andy Swick via [andymswick@gmail.com](mailto:andymswick@gmail.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
