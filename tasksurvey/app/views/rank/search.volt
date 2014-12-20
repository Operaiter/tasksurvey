
{{ content() }}

<table width="100%">
    <tr>
        <td align="left">
            {{ link_to("rank/index", "Go Back") }}
        </td>
        <td align="right">
            {{ link_to("rank/new", "Create ") }}
        </td>
    </tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>Rank</th>
            <th>Name</th>
            <th>Name Of Short</th>
            <th>Description</th>
         </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for rank in page.items %}
        <tr>
            <td>{{ rank.rank_id }}</td>
            <td>{{ rank.name }}</td>
            <td>{{ rank.name_short }}</td>
            <td>{{ rank.description }}</td>
            <td>{{ link_to("rank/edit/"~rank.rank_id, "Edit") }}</td>
            <td>{{ link_to("rank/delete/"~rank.rank_id, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td>{{ link_to("rank/search", "First") }}</td>
                        <td>{{ link_to("rank/search?page="~page.before, "Previous") }}</td>
                        <td>{{ link_to("rank/search?page="~page.next, "Next") }}</td>
                        <td>{{ link_to("rank/search?page="~page.last, "Last") }}</td>
                        <td>{{ page.current~"/"~page.total_pages }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>
