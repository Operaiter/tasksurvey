
{{ content() }}

<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("user_access/index", "Go Back") }}
        </td>
        <td align="right">
            {{ link_to("user_access/new", "Create ") }}
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>User</th>
            <th>Access</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for user_acces in page.items %}
        <tr>
            <td>{{ user_acces.user_id }}</td>
            <td>{{ user_acces.access_id }}</td>
            <td>{{ link_to("user_access/edit/"~user_acces.user_id, "Edit") }}</td>
            <td>{{ link_to("user_access/delete/"~user_acces.user_id, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td>{{ link_to("user_access/search", "First") }}</td>
                        <td>{{ link_to("user_access/search?page="~page.before, "Previous") }}</td>
                        <td>{{ link_to("user_access/search?page="~page.next, "Next") }}</td>
                        <td>{{ link_to("user_access/search?page="~page.last, "Last") }}</td>
                        <td>{{ page.current~"/"~page.total_pages }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
