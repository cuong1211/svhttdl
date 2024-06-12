<x-website-layout>
    <section>
        <style>
            html,
            body {
                width: 100%;
                height: 100%;
                padding: 0;
                margin: 0;
                overflow: hidden;
                font-family: Helvetica;
            }

            #tree {
                width: 100%;
                height: 100%;
            }
        </style>
        <div class="mx-auto mt-6 max-w-7xl px-3 sm:px-6 md:items-center lg:px-8">
            <div id="tree"></div>
        </div>

    </section>
    @push('scripts_bottom')
        
        <script>
            let chart = new OrgChart(document.getElementById("tree"), {
                mouseScrool: OrgChart.action.none,
                nodeBinding: {
                    field_0: "name"
                },
                enableDragDrop: true,
                nodes: [{
                        id: 1,
                        name: "Amber McKenzie"
                    },
                    {
                        id: 2,
                        pid: 1,
                        name: "Ava Field"
                    },
                    {
                        id: 3,
                        pid: 1,
                        name: "Peter Stevens"
                    }
                ]
            });
        </script>
    @endpush
</x-website-layout>
