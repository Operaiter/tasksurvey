
{{ content() }}

<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("mission/index", "Go Back") }}
        </td>
        <td align="right">
            {{ link_to("mission/new", "Create ") }}
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>Mission</th>
            <th>Time</th>
            <th>Active</th>
            <th>Time Of Change</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for mission in page.items %}
        <tr>
            <td>{{ mission.mission_id }}</td>
            <td>{{ mission.time }}</td>
            <td>{{ mission.active }}</td>
            <td>{{ mission.time_change }}</td>
            <td>{{ link_to("mission/edit/"~mission.mission_id, "Edit") }}</td>
            <td>{{ link_to("mission/delete/"~mission.mission_id, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td>{{ link_to("mission/search", "First") }}</td>
                        <td>{{ link_to("mission/search?page="~page.before, "Previous") }}</td>
                        <td>{{ link_to("mission/search?page="~page.next, "Next") }}</td>
                        <td>{{ link_to("mission/search?page="~page.last, "Last") }}</td>
                        <td>{{ page.current~"/"~page.total_pages }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
