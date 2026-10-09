


        $(document).ready(function () {
            $('#accountsTable').DataTable({
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                ordering: true,
                searching: true,
                language: {
                    emptyTable: 'No accounts found.'
                }
            });
        });

