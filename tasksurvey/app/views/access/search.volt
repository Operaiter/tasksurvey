
{{ content() }}

<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("access/index", "Go Back") }}
        </td>
        <td align="right">
            {{ link_to("access/new", "Create ") }}
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>Access</th>
            <th>Name</th>
            <th>Description</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for acces in page.items %}
        <tr>
            <td>{{ acces.access_id }}</td>
            <td>{{ acces.name }}</td>
            <td>{{ acces.description }}</td>
            <td>{{ link_to("access/edit/"~acces.access_id, "Edit") }}</td>
            <td>{{ link_to("access/delete/"~acces.access_id, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td>{{ link_to("access/search", "First") }}</td>
                        <td>{{ link_to("access/search?page="~page.before, "Previous") }}</td>
                        <td>{{ link_to("access/search?page="~page.next, "Next") }}</td>
                        <td>{{ link_to("access/search?page="~page.last, "Last") }}</td>
                        <td>{{ page.current~"/"~page.total_pages }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
