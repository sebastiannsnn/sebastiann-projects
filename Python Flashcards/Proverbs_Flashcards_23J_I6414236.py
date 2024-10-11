# Starter file for TM112 2023J TMA03 Q2


"""
This interactive flashcard program tests the user's knowledge of proverbial phrases.
Upon request, it presents the user with an incomplete proverbial phrase, missing the last word,
and asks the user to guess the missing word. The program then checks the user's guess against
the correct answer, offering congratulations for correct guesses or providing the correct
word for incorrect guesses. Users can continuously ask for new flashcards or choose to exit the program.
"""


from random import *

def show_flashcard():
    """ Show the user a random incomplete proverbial phrase and ask them to guess the missing word.
        Upon receiving the user's guess, the function checks its correctness against the actual
        missing word. If the guess is correct, the user is congratulated; otherwise, the correct
        word is revealed. The purpose is to test and improve the user's knowledge of common
        proverbial expressions.
    """
    # Choose a random proverb
    random_key = choice(list(proverbs_dictionary))
    print('What is the missing word? ', random_key, '------')

    # Get the user's guess
    user_guess = input('Your guess: ').strip().lower() # Ensures consistent comparison

    # Check if the guess is correct
    if user_guess == proverbs_dictionary[random_key].lower():
        print('Congratulations! You are correct.')
    else:
        print(f'Wrong. The correct answer was "{proverbs_dictionary[random_key]}".')

## Set up the proverbs_dictionary
proverbs_dictionary = {"A rolling stone gathers no":"moss",
               "More haste less":"speed",
               "Curiosity killed the":"cat",
               "Rome wasn't built in a":"day",
               "It’s no use crying over spilt":"milk",
               "Many hands make light":"work",
               "A stitch in time saves":"nine",
               "The early bird catches the ":"worm",
               "Look before you ":"leap",
               "Where there's a will there's a":"way",
               "Least said soonest":"mended",
               "A fool and his money are soon":"parted",
               "Too many cooks spoil the":"broth",
               "Fools rush in where angels fear to":"tread"
              }

# The interactive loop

exit = False
while not exit:
    user_input = input('Enter s to show a flashcard and q to quit: ')
    if user_input == 'q':
        exit = True
    elif user_input == 's':
        show_flashcard()
    else:
        print('You need to enter either q or s.')              
