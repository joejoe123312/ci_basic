<h1>Welcome to dashboard</h1>

<?php $logout = base_url() . "Login/logout" ?>
<a href="<?= $logout ?>"><button>Logout</button></a>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<table>
    <thead>
        <tr>
            <td>#</td>
            <td>Full name</td>
            <td>Email</td>
            <td>Mobile number</td>
            <td>Address</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<script>
    $(document).ready(function() {
        let table = 'users';

        $('tbody').load("<?= base_url() ?>CrudEndpoint/GetAllForTable?table=" + table);

        // $.post("<?= base_url() ?>CrudEndpoint/Update?table=" + table, {
        //     id: 3,
        //     fullname: "Joshua Corpuz",
        //     email: "joshua@gmail.com",
        //     mobile_number: 09657897878,
        //     credentials_id: 5,
        // }, function(resp) {
        //     console.log(resp);
        // });

        // $.post("<?= base_url() ?>CrudEndpoint/Delete?table=" + table, {
        //     id: 3
        // }, function() {
        //     console.log("deleted");
        // });
    });
</script>