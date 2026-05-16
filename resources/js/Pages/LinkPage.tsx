import { Head } from '@inertiajs/react';

const cardBg: React.CSSProperties = { background: 'linear-gradient(135deg, rgba(60,94,119,0.25) 0%, rgba(31,49,68,0.2) 40%, rgba(1,5,17,0.9) 100%)' };

type LinkItem = { label: React.ReactNode; icon: string; iconLeft: string; iconTop: string; iconSize: string; href: string };

const links: LinkItem[] = [
    { label: <><span>UMN Informatics Student </span><span style={{ fontFamily: 'var(--font-kanit)' }}>Aspiration Form</span></>, icon: '/assets/LinkPage/aspiration.svg', iconLeft: '-78px', iconTop: '35px', iconSize: '263px', href: '/aspirationForm' },
    { label: 'Instagram @hmif.umn', icon: '/assets/LinkPage/instagram.svg', iconLeft: '-45px', iconTop: '64px', iconSize: '204px', href: 'https://instagram.com/hmif.umn' },
    { label: 'Website Himpunan Mahasiswa Informatika', icon: '/assets/LinkPage/website.svg', iconLeft: '-61px', iconTop: '40px', iconSize: '246px', href: 'https://if.umn.ac.id' },
    { label: 'For Business Inquiries (Internal UMN)', icon: '/assets/LinkPage/business.svg', iconLeft: '-22px', iconTop: '35px', iconSize: '206px', href: 'mailto:hmif@umn.ac.id' },
    { label: 'For Business Inquiries (External UMN 1)', icon: '/assets/LinkPage/business.svg', iconLeft: '-22px', iconTop: '35px', iconSize: '206px', href: 'mailto:rnd.hmif@gmail.com' },
    { label: 'For Business Inquiries (External UMN 2)', icon: '/assets/LinkPage/business.svg', iconLeft: '-22px', iconTop: '35px', iconSize: '206px', href: 'mailto:rnd.hmif@gmail.com' },
];

function LinkCard({ item }: { item: LinkItem }) {
    return (
        <a href={item.href} className="relative flex h-[11.25rem] w-full shrink-0 flex-col items-start justify-between overflow-hidden rounded-2xl border-2 border-[#f0f2f5] px-10 py-11" style={cardBg}>
            <div className="relative w-full pl-38">
                <p className="w-full text-[20px] font-medium leading-normal text-[#f0f2f5]" style={{ fontFamily: 'var(--font-work-sans)' }}>{item.label}</p>
            </div>
            <img alt="" src={item.icon} className="absolute block" style={{ left: item.iconLeft, top: item.iconTop, width: item.iconSize, height: item.iconSize }} />
        </a>
    );
}

export default function LinksPage() {
    return (
        <main className="relative min-h-screen overflow-hidden bg-[#010511]">
            <Head title="Connect With Us" />
            <div className="relative mx-auto flex max-w-[69.5rem] flex-col items-center gap-[3.75rem] px-4 pb-20 pt-32">
                <div className="flex max-w-[54.5rem] flex-col items-center gap-3 text-center">
                    <h1 className="bg-gradient-to-r from-[#149ed8] to-[#005696] bg-clip-text text-[128px] font-semibold leading-[0.9] tracking-[-6.4px] text-transparent font-kanit">
                        Connect With Us
                    </h1>
                    <p className="text-[20px] font-normal leading-[1.5] text-[#c2cad6]" style={{ fontFamily: 'var(--font-work-sans)' }}>
                        Explore our community, share your aspirations, or reach out for partnerships.
                    </p>
                </div>
                <div className="grid w-full grid-cols-2 gap-5">
                    {links.map((item, i) => <LinkCard key={i} item={item} />)}
                </div>
            </div>
        </main>
    );
}
