
{{ content() }}

<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("user/index", "Go Back") }}
        </td>
        <td align="right">
            {{ link_to("user/new", "Create ") }}
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>User</th>
            <th>Unit</th>
            <th>Rank</th>
            <th>Prename</th>
            <th>Lastname</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for user in page.items %}
        <tr>
            <td>{{ user.user_id }}</td>
            <td>{{ user.unit_id }}</td>
            <td>{{ user.rank }}</td>
            <td>{{ user.prename }}</td>
            <td>{{ user.lastname }}</td>
            <td>{{ link_to("user/edit/"~user.user_id, "Edit") }}</td>
            <td>{{ link_to("user/delete/"~user.user_id, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td>{{ link_to("user/search", "First") }}</td>
                        <td>{{ link_to("user/search?page="~page.before, "Previous") }}</td>
                        <td>{{ link_to("user/search?page="~page.next, "Next") }}</td>
                        <td>{{ link_to("user/search?page="~page.last, "Last") }}</td>
                        <td>{{ page.current~"/"~page.total_pages }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
