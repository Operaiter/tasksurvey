
{{ content() }}

<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("state/index", "Go Back") }}
        </td>
        <td align="right">
            {{ link_to("state/new", "Create ") }}
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>State</th>
            <th>Partner</th>
            <th>Name</th>
            <th>Name Of Short</th>
            <th>Persistent</th>
            <th>Description</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for state in page.items %}
        <tr>
            <td>{{ state.state_id }}</td>
            <td>{{ state.partner_id }}</td>
            <td>{{ state.name }}</td>
            <td>{{ state.name_short }}</td>
            <td>{{ state.persistent }}</td>
            <td>{{ state.description }}</td>
            <td>{{ link_to("state/edit/"~state.state_id, "Edit") }}</td>
            <td>{{ link_to("state/delete/"~state.state_id, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td>{{ link_to("state/search", "First") }}</td>
                        <td>{{ link_to("state/search?page="~page.before, "Previous") }}</td>
                        <td>{{ link_to("state/search?page="~page.next, "Next") }}</td>
                        <td>{{ link_to("state/search?page="~page.last, "Last") }}</td>
                        <td>{{ page.current~"/"~page.total_pages }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
