<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Cards for self-education</title>
    <meta charset='UTF-8'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .my-container {
            padding: 20px 20px 20px 20px;

        }
    </style>
</head>
<body>
<div class="container-1 my-container">
    <div class="row">
        <div class="col my-col">
            <a href="PersonalPage.php"><button>Your cards>></button></a><br><br>

            <h1>Create new card</h1>
            <form action="CreateCard.php" method="post">
                <label for="topic">Topic:</label><br>
                <input type="text" name="topic" placeholder="Keep it short" size="20" required><br><br>

                <label for="content">Content:</label><br>

                <textarea type="text" wrap="hard" name="content" placeholder="Type your card's content" cols="40" rows="10" required></textarea><br>
                <button type="submit">Create</button>
            </form>
        </div>
        <div class="col my-col">
            <form action="/current_version_of_projects/FlashCards/MVC/cards/search" style="display: inline-block">
                <input type="text" name="search" required>
                <button type="submit">Search</button>
            </form>
            <a href="SignOut.php" style="float: right;"><button>Sign out</button></a><br><br>
        </div>
    </div>
</div>
</body>