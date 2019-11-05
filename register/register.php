<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Register</title>
  </head>
  <body>
    <form method="post">
      <select name="role">
        <!-- php which generates options based on the roles in the database -->
      </select>
      First Name: <input type="text" name="fName">
      Last Name: <input type="text" name="lName">
      Email ID: <input type="text" name="email">
      Phone: <input type="text" name="phone">
      Password: <input type="password" name="password">
      Date of Birth: <input type="date" name="date">
      Emergency Contact: <input type="text" name="emergency">
      Relation to Emergency Contact: <input type="text" name="relation">
      <!-- Family code, if the role is a family member -->
    </form>
  </body>
</html>
