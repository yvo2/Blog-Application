<table class="responsive-table bordered">
        <thead>
          <tr>
              <th>Name</th>
              <th>E-Mail</th>
              <th>Mitglied seit</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td><?=$user->name?></td>
            <td><?=$user->email?></td>
            <td><?=$user->registeredSince?></td>
          </tr>
        </tbody>
</table>
