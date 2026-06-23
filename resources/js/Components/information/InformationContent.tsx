import { router } from '@inertiajs/react';
import { useEffect, useState } from 'react';
import SectionHeader from './header';
import CardInformation from './cardInformation';
import CardOther from './otherCard';
import Card2Grid from './otherCard2';

interface Article {
    id: number;
    category: string;
    title: string;
    date: string;
    image: string;
    imageAlt: string;
    excerpt: string;
    content: string;
}

export default function InformationContent() {
    const [articles, setArticles] = useState<Record<number, Article> | null>(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);

    useEffect(() => {
        fetchArticles();
    }, []);

    const fetchArticles = async () => {
        try {
            const response = await fetch('/api/information/articles');
            if (!response.ok) throw new Error('Failed to fetch articles');
            const result = await response.json();
            setArticles(result.data);
        } catch (err) {
            setError(err instanceof Error ? err.message : 'Error fetching articles');
        } finally {
            setLoading(false);
        }
    };

    if (loading) {
        return (
            <section className="font-kanit py-8 sm:py-12 lg:py-10 mx-4">
                <SectionHeader />
                <div className="flex items-center justify-center py-12">
                    <p className="text-gray-400">Loading articles...</p>
                </div>
            </section>
        );
    }

    if (error || !articles) {
        return (
            <section className="font-kanit py-8 sm:py-12 lg:py-10 mx-4">
                <SectionHeader />
                <div className="flex items-center justify-center py-12">
                    <p className="text-red-400">Error loading articles. Please try again later.</p>
                </div>
            </section>
        );
    }

    const featured = articles[1];
    const otherArticles = [articles[2], articles[3], articles[4]];
    const card2Articles = [articles[2], articles[4], articles[3], articles[1]];

    return (
        <section className="font-kanit py-8 sm:py-12 lg:py-10 mx-4">
            <SectionHeader />
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8 items-start">
                <CardInformation category={featured.category} title={featured.title} date={featured.date} image={featured.image} imageAlt={featured.imageAlt} onReadMore={() => router.visit('/information/detail/1')} />
                <div className="lg:h-[36rem] border border-cyan-400/40 bg-slate-900/70 rounded-2xl p-4 sm:p-5 lg:p-6 flex flex-col h-auto hover:shadow-lg transition-shadow duration-300">
                    {otherArticles.map((article, index) => (
                        <CardOther key={article.id} category={article.category} title={article.title} date={article.date} excerpt={article.excerpt} image={article.image} onClick={() => router.visit(`/information/detail/${article.id}`)} isLast={index === otherArticles.length - 1} />
                    ))}
                </div>
            </div>
            <div className="mt-12 lg:mt-16">
                <Card2Grid cards={card2Articles.map((card) => ({ category: card.category, title: card.title, date: card.date, image: card.image, imageAlt: card.imageAlt, onReadMore: () => router.visit(`/information/detail/${card.id}`) }))} />
            </div>
        </section>
    );
}
