import { Match } from "@/interfaces/Match";
import { PageProps } from "@/types";
import MatchCard from "@/Components/Organisms/MatchCard";
import { Head } from "@inertiajs/react";
import Layout from "@/Layouts/Layout";
import SelectOptionsProps from "@/Models/SelectOptionsProps";
import { MatchResponse } from "@/Models/PaginationMeta";
import Pagination from "@/Components/Organisms/Pagination";

export default function Matchs({
    auth,
    matchs,
    volunteerTypes,
    localTeamName,
}: PageProps<{
    matchs: MatchResponse;
    volunteerTypes: Array<SelectOptionsProps>;
    localTeamName: string;
}>) {
    return (
        <>
            <Head title={localTeamName + " - Les matchs "} />
            <Layout user={auth.user}>
                <article className="matchs-content">
                    <h2>Les matchs</h2>
                    <section className={"matchs-display"}>
                        {matchs.data.map((match: Match) => (
                            <MatchCard
                                key={match.uuid}
                                visitorTeamName={match.visitorTeam.name}
                                category={match.category}
                                gameDate={match.gameDate}
                                isHomeMatch={match.isHomeMatch}
                                gameId={match.uuid.toString()}
                                volunteerTypes={volunteerTypes}
                            />
                        ))}
                    </section>
                    <Pagination links={matchs.meta.links} />
                </article>
            </Layout>
        </>
    );
}
