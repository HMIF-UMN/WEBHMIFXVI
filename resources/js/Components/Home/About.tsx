import Button from '@/components/ui/Button';

const TAGLINES = ['Innovate.', 'Inspire.', 'Impact.'] as const;

export default function AboutSection() {
    return (
        <section className="relative w-full min-h-screen flex items-center overflow-hidden bg-[#010511] py-20 lg:py-0">
            <div className="absolute z-0 pointer-events-none" style={{ top: '50%', left: '25%', width: '50vw', height: '50vw', minWidth: '600px', minHeight: '600px', transform: 'translate(-50%, -50%)', background: 'radial-gradient(circle, rgba(20,158,216,0.3) 0%, transparent 65%)', mixBlendMode: 'color-dodge', filter: 'blur(50px)' }} />

            <div className="absolute inset-y-0 right-0 z-0 w-[80%] lg:w-[50%] pointer-events-none opacity-40 lg:opacity-100">
                <img src="/assets/Home/supergraphics3.svg" alt="" className="w-full h-full object-cover object-right" />
            </div>

            <div className="relative z-10 w-full flex flex-col lg:flex-row items-center justify-between">
                <div className="w-full lg:w-auto pl-[clamp(32px,8vw,120px)] flex flex-col">
                    {TAGLINES.map((word, i) => (
                        <p key={word} className="font-kanit font-semibold m-0 select-none" style={{ fontSize: 'clamp(80px, 15vw, 200px)', lineHeight: 0.9, letterSpacing: '-0.04em', marginBottom: i < TAGLINES.length - 1 ? '-0.069em' : 0, color: 'transparent', backgroundImage: 'linear-gradient(180deg, #149ED8 0%, #0362A1 100%)', WebkitBackgroundClip: 'text', backgroundClip: 'text' }}>
                            {word}
                        </p>
                    ))}
                </div>

                <div className="w-full lg:max-w-xl text-right px-8 mt-16 lg:mt-0 lg:mr-24" style={{ fontFamily: 'var(--font-work-sans)' }}>
                    <p className="text-white/70 text-[clamp(13px,0.95vw,16px)] leading-[1.85] mb-8">
                        As part of our mission, HMIF adopts a tagline that reflects the values and objectives behind its establishment:{' '}
                        <strong className="text-white font-semibold">Innovate, Inspire, Impact.</strong>{' '}
                        These three words represent HMIF&apos;s commitment
                    </p>
                    <div className="flex justify-end">
                        <Button href="/aboutUs">Get to know us</Button>
                    </div>
                </div>
            </div>
        </section>
    );
}
