const socialLinks = [
    { icon: '/assets/Home/contactus/email.svg', label: 'hmif@umn.ac.id', href: 'https://mail.google.com/mail/u/0/?fs=1&to=hmif@umn.ac.id&tf=cm' },
    { icon: '/assets/Home/contactus/discord.svg', label: 'Discord Informatika UMN', href: 'https://discord.gg/ywjuhAmXut' },
    { icon: '/assets/Home/contactus/line.svg', label: '@682fnddg (Line Official HMIF UMN)', href: 'https://line.me/ti/p/~@682fnddg' },
    { icon: '/assets/Home/contactus/ig.svg', label: '@hmif.umn', href: 'https://instagram.com/hmif.umn' },
];

const inputClass = 'w-full border border-white/30 rounded-full px-7 py-2 bg-transparent text-[#C2CAD6] text-xl placeholder:text-[#C2CAD6]/50 outline-none focus:border-[#149ED8]/60 transition-colors';

export default function ContactUs() {
    return (
        <section className="relative w-full bg-[#010511] py-24 px-6 overflow-hidden">
            <div className="max-w-7xl mx-auto flex flex-col lg:flex-row gap-16 lg:gap-24 items-center">
                <div className="flex flex-col gap-12 flex-1">
                    <div className="flex flex-col gap-3">
                        <h2 className="font-kanit text-[clamp(72px,10vw,128px)] leading-[0.9] tracking-[-6.4px] bg-gradient-to-r from-[#149ED8] to-[#005696] bg-clip-text text-transparent">
                            Contact Us
                        </h2>
                        <p className="text-[#C2CAD6] text-xl leading-relaxed" style={{ fontFamily: 'var(--font-work-sans)' }}>
                            Got an idea? let&apos;s build it.<br />connect with us and create lasting impact.
                        </p>
                    </div>
                    <div className="flex flex-col gap-7">
                        {socialLinks.map(({ icon, label, href }) => (
                            <a key={label} href={href} target="_blank" rel="noopener noreferrer" className="flex items-center gap-6 group">
                                <div className="w-[42px] h-[42px] shrink-0">
                                    <img src={icon} alt="" className="w-full h-full object-contain" />
                                </div>
                                <span className="text-[#C2CAD6] text-xl tracking-[1px] underline underline-offset-2 group-hover:text-[#149ED8] transition-colors" style={{ fontFamily: 'var(--font-work-sans)' }}>
                                    {label}
                                </span>
                            </a>
                        ))}
                    </div>
                </div>

                <div className="flex-1 w-full max-w-[726px] rounded-2xl border-2 border-[#F0F2F5]/20 p-[43px] flex flex-col gap-12" style={{ background: 'radial-gradient(ellipse at 60% 110%, rgba(60,94,119,0.20) 0%, rgba(16,27,42,0.20) 50%, rgba(1,5,17,0.20) 100%), linear-gradient(90deg, rgba(60,64,74,0.15) 0%, rgba(60,64,74,0.15) 100%)', backdropFilter: 'blur(20px)' }}>
                    <div className="flex flex-col gap-2">
                        <h3 className="font-kanit text-[#F0F2F5] text-[40px] leading-[0.9] tracking-[-2px]">Get in Touch</h3>
                        <p className="text-[#C2CAD6] text-xl" style={{ fontFamily: 'var(--font-work-sans)' }}>Reach us anytime.</p>
                    </div>
                    <div className="flex flex-col gap-5">
                        <div className="flex gap-5">
                            <div className="flex flex-col gap-2 flex-1">
                                <label className="text-[#C2CAD6] text-xl font-semibold" style={{ fontFamily: 'var(--font-work-sans)' }}>First Name</label>
                                <input type="text" placeholder="Jane" className={`${inputClass}`} style={{ fontFamily: 'var(--font-work-sans)' }} />
                            </div>
                            <div className="flex flex-col gap-2 flex-1">
                                <label className="text-[#C2CAD6] text-xl font-semibold" style={{ fontFamily: 'var(--font-work-sans)' }}>Last Name</label>
                                <input type="text" placeholder="Doe" className={`${inputClass}`} style={{ fontFamily: 'var(--font-work-sans)' }} />
                            </div>
                        </div>
                        <div className="flex flex-col gap-2">
                            <label className="text-[#C2CAD6] text-xl font-semibold" style={{ fontFamily: 'var(--font-work-sans)' }}>Email</label>
                            <input type="email" placeholder="your@email.com" className={inputClass} style={{ fontFamily: 'var(--font-work-sans)' }} />
                        </div>
                        <div className="flex flex-col gap-2">
                            <label className="text-[#C2CAD6] text-xl font-semibold" style={{ fontFamily: 'var(--font-work-sans)' }}>Message</label>
                            <textarea placeholder="Leave us a message..." rows={5} className="w-full border border-white/30 rounded-[33px] px-7 py-3 bg-transparent text-[#C2CAD6] text-xl placeholder:text-[#C2CAD6]/50 outline-none focus:border-[#149ED8]/60 transition-colors resize-none" style={{ fontFamily: 'var(--font-work-sans)' }} />
                        </div>
                    </div>
                    <button className="w-full h-[60px] border border-white/30 rounded-full text-[#C2CAD6] text-xl hover:border-[#149ED8]/60 hover:text-[#149ED8] transition-colors cursor-pointer" style={{ fontFamily: 'var(--font-work-sans)', background: 'radial-gradient(ellipse at 50% 110%, rgba(60,94,119,0.20) 0%, rgba(1,5,17,0.11) 100%)' }}>
                        Submit
                    </button>
                </div>
            </div>
        </section>
    );
}
