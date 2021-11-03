import Head from 'next/head';
import Link from 'next/link'
import Layout from '../components/layout'
import Search from "../components/searchBar"


export default function HomeScreen() {
  return (
    <Layout>
    <Head>
      <title>Random Bandz</title>
      <link rel="icon" href="/favicon.ico" />
    </Head>

    <div className="navbar">
      <Link href="">Profile</Link>
      <Search />
    </div>

    </Layout>
  )
}
